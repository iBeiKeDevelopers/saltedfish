<?php

namespace App\Http\Controllers\API;

use App\Models\Goods;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @api
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        $num = $request->input('num', 12);
        $page = ($page - 1) * $num;
        
        $goods = Goods::skip($page)->take($num)->get();
        foreach($goods as $g) {
            $g->thumbnail;
            $g->browse;
        }
        return $goods;
    }

    /**
     * list goods of the same owner
     * @api
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function list(int $uid)
    {
        $goods = Goods::where('owner', $uid)->get();
        foreach($goods as $g) {
            $g->thumbnail;
            $g->browse;
        }
        return $goods;
    }

    /**
     * Store a newly created resource in storage.
     * @api
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     * @api
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //return Auth::auth();
        $good = Goods::findOrFail($id);
        $good->images;
        $good->comments;
        return $good;
    }

    /**
     * Update the specified resource in storage.
     * @api
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @api admin
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
