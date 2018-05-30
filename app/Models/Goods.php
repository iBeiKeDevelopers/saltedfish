<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Database;

use App\Models\Report;

//todo: try to seperate comments from goods

class Goods extends Model implements Report
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

            $goods_tags_str = '';
            foreach($res->goods_tags as $tag){
                $tag = urlencode($tag);
                $goods_tags_str = $goods_tags_str." ".$tag;
            }
            $res->goods_tags = $goods_tags_str;

            
            $res[$i]->goods_title       =       urlencode($res[$i]->goods_title);
            $res[$i]->single_cost       =       urlencode($res[$i]->single_cost);
            $res[$i]->search_summary    =       urlencode(mb_substr($res->goods_info,0,100,"utf-8").";".$goods_type.";".$goods_title.";".$lv1.";".$lv2.";".$lv3.";".$goods_tags_str);
            $res[$i]->goods_info        =       urlencode($res[$i]->goods_info);
            $res[$i]->comments          =       urlencode($res[$i]->comments);
            $res[$i]->goods_img         =       urlencode($res[$i]->goods_img);
            $res[$i]->cl_lv_1           =       urlencode($res[$i]->cl_lv_1);
            $res[$i]->cl_lv_2           =       urlencode($res[$i]->cl_lv_2);
            $res[$i]->cl_lv_3           =       urlencode($res[$i]->cl_lv_3);

            if ($res->remain == 0)
		        $res->status = "soldout";
        }
        return $res;
    }

    public function update_goods($goods, $user) { //更新商品信息 && 提交商品
        //before db,after json
        $now = date("Y/m/d");
        $goods->last_modified = $now;
        if($goods->goods_id == null) { //new
            $goods->ttm = $now;
            if(DB::table(config('tables.goods'))->insert($goods))
                return [
                    "status" => "true",
                    "goods_id"  =>  "$id",
                ];
            else return Report::report(false, 'DB error');
        }else { //update
            $id = $this->getOwner($goods->goods_id);
            if($id == $user) {
                //
                $res = DB::table(config('tables.goods'))->where('goods_id', "$id")->update($goods);
                return Report::report($res, "DB error");
            }else {
                Report::report(false, "not owner");
            }
        }
    }

    public function comment($id, $comment) { //评论商品
		$comment_ele = array(
			'commenter'     =>      $commenter,
			'comment_date'  =>      Date("Y-m-d"),
			'comment'       =>      urlencode($comment),
        );
        $res = qurey($id);
        if($res == null) return "No such goods";

        $old_comment = json_decode($res->comments);
		array_unshift($old_comment, $comment_ele);
		$updated_comment = json_encode($old_comment);
        $status = DB::table(config('tables.goods'))->where('goods_id', "$goods_id")->update(['comments' => "$updated_comment"]);
        return Report::report($status);
    }

    public function revoke($id, $user) {
        $res = select(config('tables.goods'), $id);
        if($res == null)
            return Report::report(false, "No such goods");

        if(intval($res->goods_owner) != $user)
            return Report::report(false, "access denied");
        else
            DB::table(config('tables.goods'))->where('goods_id', $id)->update(['goods_status' => 'unavailable']);
        return Report::report(true);
    }

    public function remove($id, $user) { //删除商品

    }

    public function getGoods($id) {
        $res = select($id);
        if($res == null) return 'No such goods.';
        return decode_db($res);
    }

    public function getOwner($id) { //商家
        $database = new Database;
        $res = $database->select(config('tables.goods'), $id);
        if(count($res) == 0)
            return null;
        else
            return $res->goods_owner;
    }

    public function change_remains($id, $num) { //商品数量增减
        $database = new Database;
        $res = $database->select(config('tables.goods'), $id);
        $updated_remain = $res->remain - $num;
        if(DB::table(config('tables.goods'))->where('id', $id)->update(['remain' => "$updated_remain"]))
            return true;
    }

    public function report($status, $error = '') {
        return ($status) ? [
            "status"    =>      "true",
            "error"     =>      "",
        ] : [
            "ststus"    =>      "false",
            "error"     =>      "$error",
        ];
    }

    public function update_db($id, $arr) {
        $res = DB::table(config('tables.goods'))
            ->where('id', "$id")->update($arr);
        return report($res, "DB error");
    }
}
