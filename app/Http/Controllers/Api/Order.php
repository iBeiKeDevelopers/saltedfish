<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

abstract class Order extends Controller
{
    //
    abstract public function new();
    abstract public function cancel();
    abstract public function accept();
    abstract public function complete();
    abstract public function finish();
}
