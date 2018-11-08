<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders_common";

    protected $fillable = [
        'gid',
        'title',
        'owner',
        'uid',
        'cost',
        'status',
    ];

    public function thumbnail() {
        return $this->hasOne('App\Models\Image', 'gid', 'gid');
    }
}
