<?php

namespace App\Models;

interface Report
{
    //Shall only used in models
    public function report($status, $error = '');
}
