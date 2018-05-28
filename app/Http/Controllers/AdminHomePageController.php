<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Models\Goods;

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
                
                return $res;
            }else if($request->input('request') == "deleteGoods") {
                $id = $request->input('id');
                $res = DB::delete("delete from salted_fish_goods where goods_id=$id");
                if($res == 1) return "OK";
            }
        }
    }
}
