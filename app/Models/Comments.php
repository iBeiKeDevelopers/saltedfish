<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    //
    protected $table = "goods_comments";

    protected $fillable = [
        'avatar',
        'content',
        'gid',
        'uid',
        'uname',
    ];
}
