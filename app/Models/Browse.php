<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Browse extends Model
{
    protected $table = "goods_browse";

    protected $primaryKey = "gid";

    protected $fillable = [
        'gid', 'like', 'view'
    ];

    public function goods() {
        return $this->belongsTo('App\Models\Goods', 'gid', 'id');
    }
}
