<?php

namespace App\Http\Controllers\API;

interface Order
{
    //
    public function new();
    public function cancel();
    public function accept();
    public function complete();
    public function finish();
}
