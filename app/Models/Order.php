<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders_common";

    public function thumbnail() {
        return $this->hasOne('App\Models\Image', 'gid', 'gid');
    }
}
