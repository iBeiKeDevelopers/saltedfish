<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Http\Controllers\Api\Info;

use App\Models\Users as UserModel;
use App\Models\Goods as GoodModel;

class HomeController extends Controller
{
    //
    private $mUser;
    private $mGoods;
    
    public function __construct()
    {
        //$this->middleware('auth');
        $mUser = new UserModel;
        $mGoods = new GoodModel;
    }

    public function index()
    {
        return "HomePage";
        //return view('home');
    }

    //goods

    public function goods_query(Request $request) {
         $mGoods;
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

    public function get_user() {
         $mUser;
        $user_info = $mUser->get();
        return json_encode(
            $mUser->report(
                ($user_info != null),
                $user_info,
                [
                    "code" => "404",
                    "message" => "without login",
                ]
            )
        );
    }
}
