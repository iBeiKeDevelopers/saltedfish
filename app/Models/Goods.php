<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    //
    public function goods_decode($arr) {
        $len = count($goods);
        for($i = 0; $i < $len; $i++) {
            $res[$i] = $goods[$i];
            
            $res[$i]->goods_title       =       urldecode($res[$i]->goods_title);
            $res[$i]->single_cost       =       urldecode($res[$i]->single_cost);
            $res[$i]->goods_info        =       urldecode($res[$i]->goods_info);
            $res[$i]->search_summary    =       urldecode($res[$i]->search_summary);
            $res[$i]->comments          =       urldecode($res[$i]->comments);
            $res[$i]->goods_img         =       urldecode($res[$i]->goods_img);
            $res[$i]->cl_lv_1           =       urldecode($res[$i]->cl_lv_1);
            $res[$i]->cl_lv_2           =       urldecode($res[$i]->cl_lv_2);
            $res[$i]->cl_lv_3           =       urldecode($res[$i]->cl_lv_3);
        } //decode
    }
}
