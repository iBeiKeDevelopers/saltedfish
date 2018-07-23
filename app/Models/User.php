<?php

namespace App\Models;

use Auth;

use Illuminate\Database\Eloquent\Model;

use App\Models\Interfaces\Database;

class User extends Model
{
    //using Auth in laravel
    
    public function ckeck() {
        return Auth::check();
    }

    public function logout() {
        return Auth::logout();
    }

    public function get($info = '') {
        switch($info) {
            case '':
                return Auth::user();
            case 'id':
                return Auth::user()->id;
            case 'group':
                return Auth::user()->group;
        }
    }

    //interface Report
    public function report($status, $data = '', $error = '') {
        return ($status) ? [
            "status"    =>      "true",
            "data"      =>      $data,
        ] : [
            "status"    =>      "false",
            "error"     =>      $error,
        ];
    }

    //obligate interfaces
    //that means tey are not in use now
    public function update_db($arr = []) {}
    public function delete_db($id) {}
}
