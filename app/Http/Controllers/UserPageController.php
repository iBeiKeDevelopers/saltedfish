<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Goods;
use App\Models\Orders;
use App\Models\Database;
use App\Models\Input;

class UserPageController extends Controller implements Api\Operation, Api\Order
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $mUser      =   new User;
        $mGoods     =   new Goods;
        $mOrders    =   new Orders;
        $mData      =   new Database;
        $mInput     =   new Input;
    }

    public function index(Request $request) {
        if($request->isMethod('get')) {
            //get
            return "UserPage";
            //return view("user");
        }else
            //post
            return ;
    }

    //goods
    
    /**
     * @api goods_submit(Request $request)
     * [
     * ('goods_id'          =>      goods_id,)
     * 
     *  'goods_title'       =>      goods_title,
     *  'single_cost'       =>      single_cost,
     *  'goods_status'      =>      goods_status,
     *  'goods_type'        =>      goods_type,
     *  'goods_remain'      =>      remain,
     *  'goods_tags'        =>      tags,
     *  'goods_img'         =>      goods_img,
     *  'delevery_fee'      =>      delivery_fee,
     *  'lv1'               =>      cl_lv_1,
     *  'lv2'               =>      cl_lv_2,
     *  'lv3'               =>      cl_lv_3,
     * ]
     */
    public function goods_submit($request) {

        $goods = $mInput->goods($resquest);
        $goods = $mGoods->encode($goods);
        $user = $mUser->get();

        return json_encode(
            $mGoods->update($goods,$user)
        );
    }

    /**
     * @api goods_revoke(Request $request)
     * [
     *  'goods_id'  =>  goods_id
     * ]
     */
    public function goods_revoke($request) {
        $id = $request->input('goods_id');
        $user = $mUser->get();

        if($Goods->checkOwner($id, $user))
            //
            return $mGoods->revoke($id, $user);
        else
            //
            return json_encode(
                $mGoods->report(false, "not owner")
            );
    }

    /**
     * @api goods_edit(Request $request)
     * [
     *  'goods_id'  =>  goods_id
     * ]
     */
    public function goods_edit($request) {
        $id = $request->input('goods_id');
        $user = $mUser->get();

        if($mGoods->checkOwner($id, $user))
            //
            return $this->goods_submit($request);
        else
            //
            return json_encode(
                $mGoods->report(false, "not owner")
            );
    }

    //orders
    
    /**
     * @api order_new(Request $request)
     * [
     *  'goods_id'          =       goods_id,
     *  'order_type'        =       order_type,
     *  'rent_duration'     =       0 || rent_dutation,
     *  'delivery_fee'      =       delivery_fee,
     *  'purchase_amount'   =       purchase_amount,
     *  'single_cost'       =       single_cost,
     *  'offer'             =       offer,
     * ]
     */
    public function order_new($request) {
        $order = $mInput->order($resquest);
        $id = $mOrders->new($order);
        return $mOrders->report($id);
    }

    /**
     * @api order_accept(Resquest $request)
     */
    public function order_accept($request) {
        $id = $request->input('order_id');
        $user = $mUser->get();
        if($id == null)
            return $mOrders->report(false, "order id missing");
        
        return json_encode(
            $mOrders->accept($id, $user)
        );
    }

    /**
     * @api order_complete(Request $request)
     * [
     *  'order_id' => order_id, 
     * ]
     */
    public function order_complete($request) {
        $id = $request->input('order_id');
        $user = $mUser->get();
        if($id == null)
            return $mOrders->report(false, "order id missing");
        
        return json_encode(
            $mOrders->complete($id, $user)
        );
    }

    /**
     * @api order_finish(Request $request)
     * [
     *  'order_id' => order_id, 
     * ]
     */
    public function order_finish($request) {
        $id = $request->input('order_id');
        $user = $mUser->get();
        if($id == null)
            return $mOrders->report(false, "order id missing");

        return json_encode(
            $mOrders->finish($id, $user)
        );
    }

    /**
     * @api order_cancel(Resquest $request)
     * [
     *  'order_id' => order_id, 
     * ]
     */
    public function order_cancel($request) {
        $id = $request->input('order_id');
        $user = $mUser->get();
        if($id == null)
            return $mOrders->report(false, "order id missing");

        return json_encode(
            $mOrders->cancel($id, $user)
        );
    }
}
