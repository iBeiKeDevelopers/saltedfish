<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Goods extends Model
{
    use SoftDeletes;

    protected $table = 'goods_common';

    protected $fillable = [
        'title',
        'description',
        'owner',
        'cost',
        'remain',
        'type',
        'cat1',
        'cat2',
    ];

    public function thumbnail() {
        return $this->hasOne('App\Models\Image', 'gid');
    }

    public function images() {
        return $this->hasMany('App\Models\Image', 'gid');
    }

    public function comment() {
        return $this->hasMany('App\Models\Comment', 'gid');
    }

    public function browse() {
        return $this->hasOne('App\Models\Browse', 'gid');
    }
}
