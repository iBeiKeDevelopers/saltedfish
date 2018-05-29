<?php

namespace App\Http\Controllers\API;

interface Message
{
    //
    public function send();
    public function fetch();
    public function count();
}
