<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

//todo: try to seperate comments from goods

class Goods extends Model
{
    use SoftDeletes;

    protected $table = 'goods';

}
