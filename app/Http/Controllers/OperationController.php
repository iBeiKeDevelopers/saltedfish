<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OperationController extends Controller
{
    private $goods;
    private $orders;
    private $user;

    public function __construct() {
        $this->goods = new GoodsModel;
        $this->orders = new OrderModel;
        $this->$user = new UserModel;
    }

    /**
     * @api
     * submit goods and return an id
     * @param Illuminate\Http\Request $request
     * @return integer id
     */
    public function goods_submit(Request $request) {
        $input = new InputController;
        $arr = $input->get_from($request,'Goods');
        return GoodsModel::insertGetId($arr);
    }

    /**
     * @api
     * privillage admin required
     * revoke and make the goods in status of 404
     * @param integer id
     * @return 
     */
    public function goods_revoke(Request $request) {
        $id = $request->input('id');
        return GoodsModel::destroy($id);
    }
    public function goods_edit(Request $request) {}

    public function goods_delete($request) {
        $id = $request->input('id');
        return json_encode(
            $mGoods->delete_db($id)
        );
    }

    public function user_update(Request $request) {
        $input = new InputController;
        return json_encode(
            $input->user($request)
        );
    }
    public function order_new(Request $request) {}
    public function order_cancel(Request $request) {}
    public function order_accept(Request $request) {}
    public function order_complete(Request $request) {}
    public function order_finish(Request $request) {}
}
