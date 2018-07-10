<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

class Info
{
    /*
    public function list_orders();

    public function user_update();
    public function get_user_self();
    public function get_user_info();
    public function get_user_total();
    public function get_user_goods();
*/
    public function delete_goods($request) {
        $id = $request->input('id');
        return json_encode(
            $mGoods->delete_db($id)
        );
    }

    public function get_goods($request) {
        $num = $request->input('num');
        $page = $request->input('page');
        $page *= $num;

        $DatabaseClass = new Database;
        $goods = $DatabaseClass->select_by_limit(config('table.goods'), $page, $num);

        return json_encode(
            $mGoods->decode_db($goods)
        );
    }
}
