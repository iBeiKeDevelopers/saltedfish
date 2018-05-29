<?php

namespace App\Http\Controllers\API;

abstract class Operation
{
    //self info update
    abstract public function update_info();

    //goods info update
    abstract public function submit_goods();
    abstract public function revoke_goods();
    abstract public function edit_goods();
}
