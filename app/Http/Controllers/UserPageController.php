<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserPageController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request) {
        return "UserPage";
        //return view("user");
    }

    //goods
    
    /**
     * @api goods_submit(Request $request)
     * 
     * @param [
     *  'goods_id'          =>      goods_id,
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
     * 
     * @return integer goods_id
     */
    public function goods_new(Request $request) {
        $goods = $mInput->goods($request);
        $goods = $mGoods->encode($goods);
        $user = $mUser->get();

        return json_encode(
            $mGoods->update_goods($goods,$user)
        );
    }

    /**
     * @api goods_submit(Request $request)
     * 
     * @param [
     *  'goods_id'          =>      goods_id,
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
     * 
     * @return boolean status
     */
    public function goods_submit(Request $request) {
        $id = $request->input('goods_id');
        if($id == null)
            return Goods::report(false, '', 'missing id');
        $goods = $mInput->goods($request);
        $goods->goods_id = $id;
        $goods = $mGoods->encode($goods);
        $user = $mUser->get();

        return json_encode(
            $mGoods->update_goods($goods,$user)
        );
    }

    /**
     * @api goods_revoke(Request $request)
     * 
     * @param [
     *  'goods_id'  =>  goods_id,
     * ]
     * 
     * @return boolean status
     */
    public function goods_revoke(Request $request) {
        $id = $request->input('goods_id');
        $user = $mUser->get();

        if($Goods->checkOwner($id, $user))
            //
            return $mGoods->revoke($id, $user);
        else
            //
            return json_encode(
                Goods::report(false, '', "not owner")
            );
    }

    /**
     * @api goods_edit(Request $request)
     * 
     * @param [
     *  'goods_id'          =>      goods_id,
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
     * 
     * @return boolean status
     */
    public function goods_edit(Request $request) {
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
     * 
     * @param [
     *  'goods_id'          =       goods_id,
     *  'order_type'        =       order_type,
     *  'rent_duration'     =       0 || rent_dutation,
     *  'delivery_fee'      =       delivery_fee,
     *  'purchase_amount'   =       purchase_amount,
     *  'single_cost'       =       single_cost,
     *  'offer'             =       offer,
     * ]
     * 
     * @return integer order_id
     */
    public function order_new(Request $request) {
        $order = $mInput->order($request);
        return $mOrders->new($order);
    }

    /**
     * @api order_accept(Resquest $request)
     * 
     * @param [
     *  'order_id' => order_id, 
     * ]
     * 
     * @return boolean status
     */
    public function order_accept(Request $request) {
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
     * 
     * @param [
     *  'order_id' => order_id, 
     * ]
     * 
     * @return boolean status
     */
    public function order_complete(Request $request) {
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
     * 
     * @param [
     *  'order_id' => order_id, 
     * ]
     * 
     * @return boolean status
     */
    public function order_finish(Request $request) {
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
     * 
     * @param [
     *  'order_id' => order_id, 
     * ]
     * 
     * @return boolean status
     */
    public function order_cancel(Request $request) {
        $id = $request->input('order_id');
        $user = $mUser->get();
        if($id == null)
            return $mOrders->report(false, "order id missing");

        return json_encode(
            $mOrders->cancel($id, $user)
        );
    }
}
