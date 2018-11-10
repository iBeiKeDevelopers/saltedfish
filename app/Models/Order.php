<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $table = "orders_common";

    protected $fillable = [
        'gid',
        'title',
        'owner',
        'uid',
        'cost',
        'amount',
        'status',
    ];

    protected $hidden = [
        'deleted_at',
    ];

    public function thumbnail() {
        return $this->hasOne('App\Models\Image', 'gid', 'gid');
    }

    public function buyer() {
        return $this->hasOne('App\User\Contact', 'id', 'uid');
    }

    public function seller() {
        return $this->hasOne('App\User\Contact', 'id', 'owner');
    }
}
