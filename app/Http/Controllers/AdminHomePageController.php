<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Database;
use App\Models\Goods;

class AdminHomePageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request) {
        if($request->isMethod('get'))
            return view('admin/admin');
        else {
            if($request->input('request') == "getGoods") {
                $num = $request->input('num');
                $page = $request->input('page');
                $page *= $num;

                $DatabaseClass = new Database;
                $goods = $DatabaseClass->select_by_limit('salted_fish_goods', $page, $num);

                $GoodsClass = new Goods;
                $res = $GoodsClass->decode_db($goods);
                if($res == null)
                    return "empty";
                else
                    return $res;
            }else if($request->input('request') == "deleteGoods") {
                $id = $request->input('id');
                $res = DB::table('salted_fish_goods')->where('goods_id', '=', "$id")->delete();
                if($res == 1) return "OK";
            }
        }
    }
}
