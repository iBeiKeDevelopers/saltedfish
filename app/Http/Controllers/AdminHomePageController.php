<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Database;
use App\Models\Goods;

class AdminHomePageController extends Controller {
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
}
