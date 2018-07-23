<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Enums\ResourceType as Type;
use App\Http\Models\Report;

use App\Http\Resources\User as UserResource;
use App\Http\Resources\Goods as GoodsResource;
use App\Http\Resources\Order as OrderResource;

class InputController extends Controller
{
    public function get_from($request,$type) {
        return $this->check($request->all(), $type);
    }

    private function check($arr, $type = 'Goods') {
        $type = new Type($type);
        switch($type) {
            case Type::Goods:
                $res = new GoodsResource($arr);
            case Type::Order:
                $res = new OrderResource($arr);
            case Type::User:
                $res = new UserResource($arr);
        }
        if($res->toArray($res))
            return $arr;
        else
            return false;
    }
    
    public function order($resquest) {
        //todoooooooooooooooooooooooooooooooo

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
