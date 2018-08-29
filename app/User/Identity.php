<?php

namespace App\User;

use Illuminate\Database\Eloquent\Model;

class Identity extends Model
{
    protected $table = "users_identity";
    protected $fillable = [
        'degree', 'student_id', 'id'
    ];
}
