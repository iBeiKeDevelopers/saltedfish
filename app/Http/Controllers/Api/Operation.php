<?php

namespace App\Http\Controllers\API;

interface Operation
{
    //self info update
    public function update_info();

    //goods info update
    public function submit_goods();
    public function revoke_goods();
    public function edit_goods();
}
