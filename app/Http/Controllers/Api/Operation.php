<?php

namespace App\Http\Controllers\API;

interface Operation
{
    //goods info update
    public function goods_submit($request);
    public function goods_revoke($request);
    public function goods_edit($request);
}
