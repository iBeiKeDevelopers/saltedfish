<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Goods;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Enums\GoodsType as Type;

class UserPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request) {
        return view("user.index");
    }

    public function profile(Request $request) {
        return view('user.profile');
    }

    public function showOrders()
    {
        return view('user.orders');
    }

    public function showGoods() {
        return view('user.goods');
    }

    public function totalsize($type) {
        $model = Goods::where('owner', Auth::id());
        if($type == 'sell')
            return [
                'size'  =>  $model->where('type', 0)
                                ->orderBy('status', 'asc')
                                ->count(),
            ];
        else abort(404);
    }

    public function getGoodsList(int $page = 1, int $num = 4, string $type = '') {
        return redirect('/api/goods/list/'.Auth::id()."/$page/$num/$type");
    }
}