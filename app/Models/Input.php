<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Input extends Model
{
    //
    public function goods($resquest) {
        $goods->goods_id        =   $request->input('goods_id');
        $goods->goods_title     =   $request->input('goods_title');
        $goods->single_cost     =   $request->input('single_cost');
        $goods->goods_status    =   $request->input('goods_status');
        $goods->goods_type      =   $request->input('goods_type');
        $goods->goods_remain    =   $request->input('remain');
        $goods->goods_tags      =   $request->input('tags');
        $goods->goods_img       =   $request->input('goods_img');
        $goods->delevery_fee    =   $request->input('delivery_fee');
        $goods->lv1             =   $request->input('cl_lv_1');
        $goods->lv2             =   $request->input('cl_lv_2');
        $goods->lv3             =   $request->input('cl_lv_3');

        return $goods;
    }
    
    public function order($resquest) {
        $order->goods_id        =   $request->input('goods_id');
        $order->order_type      =   $request->input('order_type');
        
        if($order->order_type == 'rent')
            $order->rent_duration = intval($request->input('rent_dutation'));
        else
            $order->rent_duration = 0;
            
        $order->delivery_fee    =   $request->input('delivery_fee');
        $order->purchase_amount =   $request->input('purchase_amount');
        $order->single_cost     =   $request->input('single_cost');
        $order->offer           =   $request->input('offer');

        return $order;
    }
}
