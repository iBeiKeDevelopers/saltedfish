<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = "users_common";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nick_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function identity() {
        return $this->hasOne('App\User\Identity', 'id');
    }

    public function contact() {
        return $this->hasOne('App\User\Contact', 'id');
    }

    public function extend() {
        return $this->hasOne('App\User\Extend', 'id');
    }
}
