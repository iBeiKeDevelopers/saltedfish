<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Database;

class User extends Model 
{
    //
    public function revoke($id, $user) {
        $res = select('salted_fish_goods', $id);
        if($res == null) return "No such goods.";

        if(intval($res->goods_owner) != $user)
            return "access denied.";
        else
            DB::table('salted_fish_goods')->where('goods_id', $id)->update(['goods_status' => 'unavailable']);
        return "OK.";
    }
}
