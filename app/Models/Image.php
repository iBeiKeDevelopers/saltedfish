<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = "goods_image";

    protected $fillable = [
        'gid', 'path', 'src',
    ];

    public $timestamps = false;
}
