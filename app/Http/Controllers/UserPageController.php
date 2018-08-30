<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Goods;
use App\Models\Order;
use Illuminate\Http\Request;

class UserPageController extends Controller
{
    //
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
                'size'  =>  $model->where('type', $type)
                                ->orderBy('status', 'asc')
                                ->count(),
            ];
    }

    public function getGoodsList(int $page = 1, int $num = 4) {
        return redirect('/api/goods/list/'.Auth::id()."/$page/$num");
    }
}