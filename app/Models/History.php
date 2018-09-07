<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $table = "chat_history";

    protected $fillable = [
        'content', 'type', 'from', 'to',
    ];
}
