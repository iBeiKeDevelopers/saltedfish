<?php

namespace App\User;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = "users_contact";
    
    protected $fillable = [
        'college',
        'domitory',
        'room',
        'phone',
        'id',
    ];
}
