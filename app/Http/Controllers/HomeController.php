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
    }

    public function index()
    {
        return "HomePage";
        //return view('home');
    }
}
