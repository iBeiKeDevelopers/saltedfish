<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Http\Controllers\Api\Info;

class HomeController extends Controller
{
    //
    public function __construct()
    {
        //$this->middleware('auth');
        $or = "";
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
}
