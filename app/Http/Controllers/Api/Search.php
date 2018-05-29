<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

abstract class Search extends Controller
{
    //
    abstract public function goods_by_title();
    abstract public function goods_by_category();
}
