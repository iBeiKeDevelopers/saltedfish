<?php

namespace App\Http\Controllers\Resource;

use Auth;
use Carbon\Carbon;
use App\Models\Goods;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\OrderCreatedEvent as Created;
use App\Events\OrderSendingEvent as Sending;
use App\Events\OrderShippedEvent as Shipped;
use App\Events\OrderDeletedEvent as Deleted;
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

        $orders = $orders->orderBy('status', 'desc')->get();
        
        foreach($orders as $item) {
            $item->thumbnail;
        }

        if($type == 'buy') {
            foreach($orders as $item) {
                $item->phone = $item->seller->phone ?? '';
                unset($item->seller);
            }
        }else if($type == 'sell') {
            foreach($orders as $item) {
                $item->phone = $item->buyer->phone ?? '';
                unset($item->buyer);
            }
        }
        
        return $orders;
    }

    /**
     * Return query result of orders within 3 days
     * 
     * @param string $type
     * @return array $orders
     */
    public function get($type)
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

        $last = Carbon::now()->addDays(-3);

        $orders = $orders->whereDate('created_at', '>', $last)->get();
        
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
        abort(404);
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
            return '自己的商品不能买哟～';
        }

        $contact = \App\User\Contact::find(Auth::id());
        if($contact == null || $contact->phone == null) {
            return 'phone number missing';
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
    public function update(Request $request, int $id)
    {
        $order = Order::find($id);

        if($request->input('operation', '') === 'cancel')
            Event(new Canceled($order));
        else if(
            $order->status == 0 &&
            $request->input('operation', '') === 'confirm' &&
            $order->owner === Auth::id()
        )
            Event(new Sending($order));
        else if($order->status == 1 && $request->input('operation', '') === 'shipped')
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
            
        Event(new Deleted($order));
    }
}
