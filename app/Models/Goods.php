<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Database;

//todo: try to seperate comments from goods

class Goods extends Model
{
    //

    public function decode_db($arr) {
        $len = count($arr);
        if($len == 0) return null;

        for($i = 0; $i < $len; $i++) {
            $res[$i] = $arr[$i];
            
            $res[$i]->goods_title       =       urldecode($res[$i]->goods_title);
            $res[$i]->single_cost       =       urldecode($res[$i]->single_cost);
            $res[$i]->goods_info        =       urldecode($res[$i]->goods_info);
            $res[$i]->search_summary    =       urldecode($res[$i]->search_summary);
            $res[$i]->comments          =       urldecode($res[$i]->comments);
            $res[$i]->goods_img         =       urldecode($res[$i]->goods_img);
            $res[$i]->cl_lv_1           =       urldecode($res[$i]->cl_lv_1);
            $res[$i]->cl_lv_2           =       urldecode($res[$i]->cl_lv_2);
            $res[$i]->cl_lv_3           =       urldecode($res[$i]->cl_lv_3);
        }
        return $res;
    }

    public function encode_db($arr) {
        $len = count($arr);
        if($len == 0) return null;

        for($i = 0; $i < $len; $i++) {
            $res[$i] = $arr[$i];
            
            $res[$i]->goods_title       =       urlencode($res[$i]->goods_title);
            $res[$i]->single_cost       =       urlencode($res[$i]->single_cost);
            $res[$i]->goods_info        =       urlencode($res[$i]->goods_info);
            $res[$i]->search_summary    =       urlencode($res[$i]->search_summary);
            $res[$i]->comments          =       urlencode($res[$i]->comments);
            $res[$i]->goods_img         =       urlencode($res[$i]->goods_img);
            $res[$i]->cl_lv_1           =       urlencode($res[$i]->cl_lv_1);
            $res[$i]->cl_lv_2           =       urlencode($res[$i]->cl_lv_2);
            $res[$i]->cl_lv_3           =       urlencode($res[$i]->cl_lv_3);
        }
        return $res;
    }

    public function submit($goods, $user) { //更新商品信息 && 提交商品
        //before db,after json
        $now = date("Y/m/d");
        $goods->ttm = $now;
        $goods->last_modified = $now;
        
        DB::table('salted_fish_goods')->insert($goods);
    }

    public function comment($id, $comment) { //评论商品
		$comment_ele = array(
			'commenter'=>$commenter,
			'comment_date'=> Date("Y-m-d"),
			'comment' => urlencode($comment),
        );
        $res = qurey($id);
        if($res == null) return "No such goods";

        //if(isset($res['comments'])) ???
        $old_comment = json_decode($res->comments);
		array_unshift($old_comment, $comment_ele);
		$updated_comment = json_encode($old_comment);
        DB::table('salted_fish_goods')->where('goods_id', "$goods_id")->update(['comments' => "$updated_comment"]);
        return json_encode([
            "status" => "success",
        ]);
    }

    public function remove($id, $user) { //删除商品

    }

    public function getGoods($id) {
        $res = select($id);
        if($res == null) return 'No such goods.';
        $res = decode_db($res);
        return json_encode($res);
    }

    public function getOwner($id) { //商家
        $database = new Database;
        $res = $database->select('salted_fish_goods', $id);
        if(count($res) == 0)
            return null;
        else
            return $res->goods_owner;
    }

    public function change_remains($id, $num) { //商品数量增减
        $database = new Database;
        $res = $database->select('salted_fish_goods', $id);
        $updated_remain = $res->remain - $num;
        if(DB::table('salted_fish_goods')->where('id', $id)->update(['remain' => "$updated_remain"]))
            return true;
    }
}
