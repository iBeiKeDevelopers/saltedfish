<?php

namespace App\Models;

use Auth;

use Illuminate\Database\Eloquent\Model;

use App\Models\Interfaces\Database;

class User extends Model
{
    //using Auth in laravel
    //that means it is very different beyond other Models
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
        }
    }

    //obligate interfaces
    //that means tey are not in use now
    public function update_db($arr = []) {}
    public function delete_db($id) {}
}
