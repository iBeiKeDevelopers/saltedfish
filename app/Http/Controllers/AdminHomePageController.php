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
        $mGoods = new Goods;
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
     * @api/admin delete_goods(Request $request)
     * [
     *  'id'        =>      "goods_id",
     * ]
     */
    public function delete_goods($request) {
        $id = $request->input('id');
        return json_encode(
            $mGoods->delete_db($id)
        );
    }

    /**
     * @api get_gooods(Request $request)
     * [
     *  'num'       =>      number of the goods in a page,
     *  'page'      =>      number of the pages now showed,
     * ]
     */
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
