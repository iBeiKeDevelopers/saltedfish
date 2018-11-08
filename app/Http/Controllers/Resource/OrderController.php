<?php

namespace App\Http\Controllers\Resource;

use Auth;
use App\Models\Goods;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\OrderCreatedEvent as Created;
use App\Events\OrderSendingEvent as Sending;
use App\Events\OrderShippedEvent as Shipped;
use App\Events\OrderCanceledEvent as Canceled;

class OrderController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('orders.index');
    }

    public function list($type = 'buy')
    {
        $uid = Auth::id();
        if($type == 'buy') {
            $orders = Order::where('uid', $uid)->where('status', '<', '2');
        }else if($type == 'sell') {
            $orders = Order::where('owner', $uid);
        }else if($type == 'finished') {
            $orders = Order::where('uid', $uid)->where('status', '>', '1');
        }else
            abort(404);

        $orders = $orders->get();
        
        foreach($orders as $item) {
            $item->thumbnail;
        }
        
        return $orders;
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $num = $request->input('amount', 0);
        $gid = $request->input('goods_id', 0);
        if($num === 0)
            abort(403, 'number of the items can not be zero!');
        $goods = Goods::findOrFail($gid);

        if($goods->owner == Auth::id()) {
            // return 'Not OK';
        }

        $order = Order::create([
            'gid'       =>      $gid,
            'title'     =>      $goods->title,
            'owner'     =>      $goods->owner,
            'uid'       =>      Auth::id(),
            'cost'      =>      $goods->cost,
            'amount'    =>      $num,
        ]);
        if($order->id > 0) {
            Event(new Created($order));
            return 'OK';
        }
        return 'Not OK';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return view('orders.home', [
            'id'        =>      $id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, itn $id)
    {
        $order = Order::find($id);
        if($order->status == 0)
            Event(new Sending($order));
        else if($order->status == 1)
            Event(new Shipped($order));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $order = Order::find($id);
        if($order->uid != Auth::id())
            abort(404);

        Event(new Canceled($order));
    }
}
