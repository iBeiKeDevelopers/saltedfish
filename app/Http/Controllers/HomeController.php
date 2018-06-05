<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Http\Controllers\Api\Info;

use App\Models\User;
use App\Models\Goods;

class HomeController extends Controller
{
    //
    public function __construct()
    {
        //$this->middleware('auth');
        global $mUser;
        global $mGoods;
        $mUser = new User;
        $mGoods = new Goods;
    }

    public function index()
    {
        if($this->isAdmin())
            return view('admin');
        else
            return view('home');
    }

    private function isAdmin() {
        return false;
    }

    //goods

    /**
     * @api goods_show(Request $request)
     * [
     *  'rank'              =>      rank,
     *  'amount'            =>      amount,
     * ]
     */
    public function goods_query(Request $request) {
        global $mGoods;
        $rank = $request->input('rank');
        $limit = $request->input('amount');
        return json_encode(
            $mGoods->search_by('', [
                "rank"  =>  $rank,
                "limit" =>  $limit,
            ])
        );
    }

    //user

    /**
     * @api get_user()
     */
    public function get_user() {
        global $mUser;
        return $mUser->get();
    }
}
