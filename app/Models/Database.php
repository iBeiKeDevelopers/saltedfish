<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Database extends Model
{
    //select
    public function select($table_name, $id) {
        return DB::table($table_name)
        ->where('id', $id)
        ->get();
    }

    public function select_by_limit($table_name, $start, $num) {
        return DB::table($table_name)
            ->skip($start)->take($num)
            ->get();
    }

    //query
    private function query($table_name, $id) {
        return DB::table($table_name)
            ->where('goods_id', "$id")
            ->get();
    }

    //search
    public function search_all($user, $page = 1, $limit = 12) {
        $start = ($page - 1) * $limit;
        $res = DB::table('salted_fish_goods')
            ->where('goods_owner', $user)
            ->skip($start)->take($limit)
            ->get();
        return $res;
    }

    public function search_for_sale($user, $page = 1, $limit = 12) {
        $start = ($page - 1) * $limit;
        $res = DB::table('salted_fish_goods')
            ->where('goods_owner', $user)
            ->where('goods_status', 'available')
            ->skip($start)->take($limit)
            ->get();
        return $res;
    }

    public function search_by_title($title, $page, $amount) {
        $start = ($page - 1) * $limit;
        $res = DB::table('salted_fish_goods')
            ->where('goods_title', 'LIKE', "'%$title%'")
            ->where('goods_status', 'available')
            ->skip($start)->take($amount)
            ->get();
        return $res;
        //something to add??? --goods.php:503
    }

    public function search_by_category($category, $level, $page, $amount) {
        $start = ($page - 1) * $limit;
        $level = 'cl_lv_' . $level;
        $category = urlencode($category);
        $res = DB::table('salted_fish_goods')
            ->where("$level", "$category")
            ->skip($start)->take($limit)
            ->get();
        return $res;
        //the same to the above
    }
    
    public function search_by_user($user, $amount) {
        //somwwhat fetch_total_pages
        $res = DB::table('salted_fish_goods')
            ->where("goods_owner", "$user")
            ->where('goods_status', 'available')
            ->get();
        return $res;
    }
}
