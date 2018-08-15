<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

//todo: try to seperate comments from goods

class Goods extends Data
{
    use SoftDeletes;

    protected $table = 'goods';

    /**
     * decode a goods list from db
     * @param stdclass
     * @return array
     */
    public function decode_db($arr) {
        //decode from db
        $len = count($arr);
        if($len == 0)
            return Goods::report(false, '', [
                'code'  =>  500,
                'message' =>  "nothing to decode",
            ]);

        foreach($arr as $a) {
            $res = get_object_vars($a);
            foreach($res as $r)
                $r = urldecode($r);
        }
        return $res;
    }

    /**
     * encode a gods list to db: array
     * @param array
     * @return array
     */
    public function encode_db($arr) {
        $len = count($arr);
        if($len == 0)
            return Goods::report(false, '', [
                'code'  =>  500,
                'message' =>  "nothing to encode",
            ]);

        for($i = 0; $i < $len; $i++) {
            $res[$i] = $arr[$i];

            $goods_tags_str = '';
            foreach($res->goods_tags as $tag){
                $tag = urlencode($tag);
                $goods_tags_str = $goods_tags_str." ".$tag;
            }
            $res->goods_tags = $goods_tags_str;
            if ($res->remain == 0)
		        $res->status = "soldout";
        }
        return $res;
    }
}
