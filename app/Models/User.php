<?php

namespace App\Models;

use Auth;

use Illuminate\Database\Eloquent\Model;

use App\Models\Database;

class User extends Model 
{
    //
    public function ckeck() {
        return Auth::check();
    }

    public function logout() {
        return Auth::logout();
    }

    public function get($info = 'id') {
        switch($info) {
            case 'id':
                return Auth::user()->id;
        }
    }
}
