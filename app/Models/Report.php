<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    /**
     * all the functions DO NOT return with json
     * 
     * @return array [
     *      "status"    =>      @param true,
     *      "data"      =>      @param array,
     * ] or [
     *      "status"    =>      @param false,
     *      "error"     =>      @param array,
     * ]
     */

    // report success or not to the client
    public static function report($status, $data, $error) {
        return ($status) ? [
            "status"    =>      "true",
            "data"      =>      $data,
        ] : [
            "status"    =>      "false",
            "error"     =>      $error,
        ];
    }

    // return with error message
    public static function throw($error) {
        return [
            "status"    =>      "false",
            "error"     =>      $error,
        ];
    }

    // return with data
    public static function send($data) {
        return [
            "status"    =>      "true",
            "error"     =>      $data,
        ];
    }
}