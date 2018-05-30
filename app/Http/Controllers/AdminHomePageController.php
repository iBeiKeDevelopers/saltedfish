<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Database;
use App\Models\Goods;

class AdminHomePageController extends Controller implements Api\Info
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request) {
        if($request->isMethod('get')) //get
            return view('admin/admin');
        else { //post
            if($request->input('request') == "getGoods") {
                //get goods info
                return $this->get_goods($request);
            }else if($request->input('request') == "deleteGoods") {
                //delete goods from database
                return $this->delete_goods($request);
            }
        }
    }

    /**
     * @api delete_goods(Request $request)
     * [
     *  'request'   =>      'deleteGoods'
     *  'id'        =>      "goods_id",
     * ]
     */
    public function delete_goods($request) {
        $id = $request->input('id');
        $res = DB::table('salted_fish_goods')->where('goods_id', '=', "$id")->delete();
        if($res == 1)
            return json_encode([
                "status" => "true",
            ]);
        else
            return jason_encode([
                "status" => "false"
            ]);
    }

    /**
     * @api get_gooods(Request $request)
     * [
     *  'request'   =>      'getGoods',
     *  'num'       =>      number of the goods in a page,
     *  'page'      =>      number of the pages now showed,
     * ]
     */
    public function get_goods($request) {
        $num = $request->input('num');
            $page = $request->input('page');
            $page *= $num;

            $DatabaseClass = new Database;
            return $goods = $DatabaseClass->select_by_limit('salted_fish_goods', $page, $num);

            $GoodsClass = new Goods;
            $res = $GoodsClass->decode_db($goods);
            if($res == null)
                return "empty";
            else
                return $res;
    }
}
