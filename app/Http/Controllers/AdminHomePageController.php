<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
                $goods = DB::select("select * from salted_fish_goods LIMIT $page,$num");
                $len = count($goods);
                for($i = 0; $i < $len; $i++) {
                    $res[$i] = $goods[$i];
                    $res[$i]->goods_title = urldecode($res[$i]->goods_title);
                    $res[$i]->single_cost = urldecode($res[$i]->single_cost);
                    $res[$i]->goods_info = urldecode($res[$i]->goods_info);
                    $res[$i]->search_summary = urldecode($res[$i]->search_summary);
                    $res[$i]->comments = urldecode($res[$i]->comments);
                    $res[$i]->goods_img = urldecode($res[$i]->goods_img);
                    $res[$i]->cl_lv_1 = urldecode($res[$i]->cl_lv_1);
                    $res[$i]->cl_lv_2 = urldecode($res[$i]->cl_lv_2);
                    $res[$i]->cl_lv_3 = urldecode($res[$i]->cl_lv_3);
                } //decode
                return $res;
            }else if($request->input('request') == "deleteGoods") {
                $id = $request->input('id');
                $res = DB::delete("delete from salted_fish_goods where goods_id=$id");
                if($res == 1) return "OK";
            }
        }
    }
}
