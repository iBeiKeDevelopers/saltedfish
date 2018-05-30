<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Models\Goods;
use App\Models\Report;
use App\Models\Database;

class Orders extends Model implements Report
{
    //
    public function new($order, $user) {
        $data = new Database;
        $res = $data->select('salted_fish_goods', $order->goods_id);
        
        if($res == null)
            return Report::report(false, "no uch goods");

        if($res->remain < $order->purchase_amount)

            return Report::report(false, "no enough goods");
        else if($order->status != 'avalable')

            return Report::report(false, "goods not avalable");
        
        $res = DB::table(config('tables.orders'))->insert($order);
        return Report::report($res, 'DB error');
    }

    public function accept($id, $user) {
        //todo:somewhere different that may cause dump
        $data = new Database;
        $res = $data->select(config('tables.orders'), $id);
        if($res == null || $res->num_rows ==0)
            return Report::report(false, "no such order");
        else if($res->goods_owner != "$user")
            return Report::report(false, "no permission");
        else if($res->remain < $res->perchase_amount)
            return Report::report(false, "no enough goods");
        else {
            return $this->update_db($res);
        }
    }

    //todo: what is the difference between the two below?
    public function complete($id, $user) {        
        $data = new Database;
        $res = $data->select(config('tables.orders'), $id);
        $goods = new Goods;
        if($goods->getOwner($res->goods_id) != $user)
            return Report::report(false, "no permission");
        switch($res->status) {
            case "waiting":
                return Report::report(false, "not accepted");
            case "completed": case "finished":
                return Report::report(false, "already completed");
            case "accepted":
                return Report::report(false, "already accepted");
        }
        return $this->update_db($id, [
            "order_status" => "$res->status",
        ]);
    }

    public function finish($id, $user) {
        //expecting $status = "?" change to "finished"
        $data = new Database;
        $res = $data->select(config('tables.orders'), "$id");

        if($res == null)
            return Report::report(false, "DB error");

        if($user != $res->order_submitter)
            return Report::report(false, "no permission");
        switch($res->status) {
            case "waiting": case "accepted":
                return Report::report(false, "not completed");
            case "finished":
                return Report::report(false, "already finished");
        }

        return $this->update_db($id, [
            "order_status" => "finished",
        ]);
    }

    public function cancel($id, $user) {
        //todo:somewhere different that may cause dump
        $data = new Database;
        $goods = new Goods;
        $res = $data->select(config('tables.orders'), $id);
        
        if($res == null || $res->num_rows ==0)
            return Report::report(false, "no such order");
        else if($res->order_submitter == "$user")
            return Report::report(false, "no permission");
        else if($user == $goods->getOwner($res->goods_id)
            && $res->order_status != 'finished')
            //is it OK ???
            return Report::report(false, "access denied");
        else if($res->remain < $res->perchase_amount)
            return Report::report(false, "no enough goods");
        else {
            $amount = $res->remain - $res->purchase_amount;
            return $goods->update_db($res->goods_id, [
                "remain" => "$amount"
            ]);
        }
    }

    public function report($status, $error = '') {
        return ($status) ? [
            "status"    =>      "true",
            "error"     =>      "",
        ] : [
            "ststus"    =>      "false",
            "error"     =>      "$error",
        ];
    }

    public function update_db($id, $arr) {
        $res = DB::table(config('tables.orders'))->where('id', "$id")->update($arr);
        return Report::report($res, "DB error");
    }
}