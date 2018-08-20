<?php

namespace App\Http\Controllers\Resource;

use App\Models\Goods;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GoodsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show a list of the goods of the same type of a user
     * 
     * @param 
     * @return \Illuminate\Http\Response
     */
    public function list($type, $uid)
    {
        if($type == 'sell'){
            $goods = Goods::where('type', 0);
        }else if($type == 'rent') {
            $goods = Goods::where('type', 1);
        }else abort(404);

        $goods = $goods->where('owner', $uid)->orderBy('remain', 'desc')->get();
        
        foreach($goods as $g) {
            $g->thumbnail;
        }

        return $goods;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        echo view('navbar');
        echo view('goods.create');
        echo view('copyright');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Goods  $goods
     * @return \Illuminate\Http\Response
     */
    public function show(Goods $goods)
    {
        return $goods;
        echo view('navbar');
        echo view('goods.show');
        echo view('copyright');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Goods  $goods
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        echo view('navbar');
        echo view('goods.edit');
        echo view('copyright');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Goods  $goods
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        echo view('navbar');
        echo view('goods.update');
        echo view('copyright');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Goods  $goods
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        //
    }
}
