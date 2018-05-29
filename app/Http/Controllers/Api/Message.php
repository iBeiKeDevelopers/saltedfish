<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

abstract class Message extends Controller
{
    //
    abstract public function send();
    abstract public function fetch();
    abstract public function count();
}
