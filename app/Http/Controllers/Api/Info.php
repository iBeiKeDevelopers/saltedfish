<?php

namespace App\Http\Controllers\API;

use Route;

use Illuminate\Http\Request;

use App\User;

use App\Http\Resources\User as UserResource;
use App\Http\Resources\Goods as GoodsResource;
use App\Http\Resources\Order as OrderResource;

use App\Models\Goods as GoodsModel;
use App\Models\Orders as OrderModel;
use App\Models\User as UserModel;

use App\Models\Report;

class Info
{
    private $order;
    private $goods;
    private $user;

    public function __construct() {
        //$this->order = new Data(config('table.orders'));
        $this->goods = new GoodsModel;
        //$this->user = new Data(config('table.users'));
    }

    // normal query
    public function order_find() {
        $id = Route::input('id');
        return $id;
    }
    public function goods_find() {
        $id = Route::input('id');
        $res = GoodsModel::find($id);
        if($res)
            return new GoodsResource($res);
        else
            return null;
    }
    public function user_find() {
        $user = Route::input('user');
        $res = User::find($user);
        if($res)
            return new UserResource($res);
        else
            return null;
    }

    // special query
    public function get_user_self() {}
    public function get_user_info() {
        $id = Route::input('id');
        return $id;
    }
    public function get_user_total() {}

    /**
     * get all the goods that he owns
     * @param integer $user as id
     * @return string json
     */
    public function get_user_goods() {
        $user = Route::input('user');
        $res = $this->goods->search_by([
            'owner'     =>      $user,
        ]);
        return json_encode($res);
    }

    public function get_goods() {
        $num = Route::input('num', 12);
        $page = Route::input('page', 1);
        $page *= $num;

        $res = $this->goods->select_by_limit($page, $num);

        return json_encode($res);
    }


    // search
    public function search_goods_by_title() {}
    public function search_goods_by_category() {}
}
