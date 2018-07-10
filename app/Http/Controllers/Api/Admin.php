<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Api;

class Admin extends Controller
{
    //
    public function __construct() {
        $this->require('auth');
    }

    public function nothing() {
        
    }
}
