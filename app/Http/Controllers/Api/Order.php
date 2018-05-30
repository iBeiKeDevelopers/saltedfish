<?php

namespace App\Http\Controllers\API;

interface Order
{
    //
    public function order_new($request);
    public function order_cancel($request);
    public function order_accept($request);
    public function order_complete($request);
    public function order_finish($request);
}
