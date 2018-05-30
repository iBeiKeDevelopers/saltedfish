<?php

namespace App\Models\interfaces;

interface Report
{
    //Shall only used in models
    public function report($status, $error = '');
}
