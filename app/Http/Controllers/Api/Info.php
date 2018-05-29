<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

abstract class Info extends Controller
{
    //
    abstract public function list_orders();

    abstract public function user_self();
    abstract public function user_info();
    abstract public function user_update();
    abstract public function user_total();
    abstract public function user_goods();
}
