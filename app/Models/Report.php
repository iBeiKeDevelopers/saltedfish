<?php

namespace App\Models;

class Report
{
    // report success or not to the client
    public function report($status, $error = '') {
        return ($status) ? [
            "status"    =>      "true",
            "error"     =>      "",
        ] : [
            "ststus"    =>      "false",
            "error"     =>      "$error",
        ];
    }
}
