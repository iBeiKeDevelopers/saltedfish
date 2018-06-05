<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Models\Interfaces\Report;
use App\Models\Interfaces\Searchable;
use App\Models\Interfaces\Database;
use App\Models\Interfaces\Selectable;

//todo: try to seperate comments from goods

class Goods extends Model implements Report, Database, Searchable
{
    //

    public function decode_db($arr) {
        //decode from db
        $len = count($arr);
        if($len == 0)
            return Goods::report(false, '', "500 error");

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
        //encode to db
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
            $res = DB::table(config('tables.goods'))->insertGetId($goods);
            return Goods::report($res, $res, 'DB error');
        }else { //update
            $id = $this->getOwner($goods->goods_id);
            if($id == $user) {
                //
                $res = DB::table(config('tables.goods'))->where('goods_id', "$id")->update($goods);
                return Goods::report($res, '', "DB error");
            }else {
                Goods::report(false, '', "not owner");
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
        $status = DB::table(config('tables.goods'))
            ->where('goods_id', "$goods_id")
            ->update([
                'comments' => "$updated_comment"
            ]);
        return Goods::report($status, '', 'DB error');
    }

    public function revoke($id, $user) {
        $res = select(config('tables.goods'), $id);
        if($res == null)
            return Goods::report(false, '', "No such goods");

        if(intval($res->goods_owner) != $user)
            return Goods::report(false, '', "access denied");
        else
            DB::table(config('tables.goods'))
                ->where('goods_id', $id)
                ->update([
                    'goods_status' => 'unavailable'
                ]);
        return Goods::report(true, '', '');
    }

    public function remove($id, $user) { //删除商品

    }

    //interface Report
    public function report($status, $data = '', $error = '') {
        return ($status) ? [
            "status"    =>      "true",
            "data"      =>      $data,
        ] : [
            "ststus"    =>      "false",
            "error"     =>      $error,
        ];
    }

    //interface Database
    public function get($id, $info = '') {
        $res = DB::table(config('table.goods'))->where('id', $id)->get();
        if($info = '')
            return $res;
        else
            return $res[$info];
    }

    public function update_db($id, $arr) {
        $res = DB::table(config('tables.goods'))
            ->where('goods_id', "$id")->update($arr);
        return Goods::report($res, '', "DB error");
    }

    public function delete_db($id) {
        $res = DB::table(config('table.goods'))
            ->where('goods_id', "$id")->delete();
        return Goods::report($res, '', "DB error");
    }

    //interface Searchable

    public function search_by($info = '', $arr = []) {
        $page   =   isset($arr["page"]) ? $arr["page"] : 1;
        $limit  =   isset($arr["limit"])? $arr["limit"] : 1;
        $start  =   ($page - 1) * $limit;

        $user   =   isset($arr['user']) ? $arr['user'] : '';
        $id     =   isset($arr['id']) ? $arr['id'] : 0;

        if($page < 1 || $limit < 0)
            return Goods::report(false, '', "invalid request");

        $level = 'cl_lv_' . (isset($arr["level"]) ? $arr["level"] : '');
        $category = isset($arr["category"]) ? urlencode($arr["category"]) : '';

        switch($info) {
            case "id": {
                $res = DB::table(config('table.goods'))
                    ->where('goods_id', "$id")
                    ->get();
                return Goods::report(
                    $res,
                    $this->decode_db($res),
                    "DB error"
                );
            }

            case "sale": {
                $res = DB::table(config('table.goods'))
                    ->where('goods_owner', $user)
                    ->where('goods_status', 'available')
                    ->skip($start)->take($limit)
                    ->get();
                    return Goods::report(
                        $res,
                        $this->decode_db($res),
                        "no such goods"
                    );
            }

            case "title": {
                $res = DB::table(config('table.goods'))
                    ->where('goods_title', 'LIKE', "'%$title%'")
                    ->where('goods_status', 'available')
                    ->skip($start)->take($limit)
                    ->get();
                    return Goods::report(
                        $res,
                        $this->decode_db($res),
                        "no such goods"
                    );
            }

            case "category": {
                $res = DB::table(config('table.goods'))
                    ->where("$level", "$category")
                    ->skip($start)->take($limit)
                    ->get();
                    return Goods::report(
                        $res,
                        $this->decode_db($res),
                        "no such goods"
                    );
            }

            case "owner": {
                $res = DB::table(config('table.goods'))
                    ->where('goods_owner', $user)
                    ->skip($start)->take($limit)
                    ->get();
                    return Goods::report(
                        $res,
                        $this->decode_db($res),
                        "no such goods"
                    );
            }

            default: {
                $res = DB::table(config('table.goods'))
                    ->skip($start)->take($limit)
                    ->get();
                return Goods::report(
                    $res,
                    $this->decode_db($res),
                    "invalid request"
                );
            }
        }
    }
}
