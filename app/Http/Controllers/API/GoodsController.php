<?php

namespace App\Http\Controllers\API;

use App\Models\Goods;
use App\Models\Browse as GoodsBrowse;
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
    public function list(int $uid, int $page = 1, int $num = 4)
    {
        $goods = Goods::where('owner', $uid)
            ->orderBy('updated_at', 'desc')
            ->skip($page*$num)->take($num)->get();
        foreach($goods as $g) {
            $g->thumbnail;
            $g->browse;
        }
        return $goods;
    }

    public function new($num = 4)
    {
        $num = 
        $goods = Goods::latest()->take($num)->get();
        foreach($goods as $g) {
            $g->thumbnail;
        }
        return $goods;
    }

    public function hot($num = 4)
    {
        $goods = [];
        $idList = GoodsBrowse::orderBy('view', 'desc')
            ->take($num)->pluck('gid');
        foreach($idList as $id) {
            $g = Goods::find($id);
            $g->thumbnail;
            array_push($goods, $g);
        }
        return $goods;
    }

    public function random($num = 4)
    {
        $goods = Goods::inRandomOrder()
            ->take($num)->get();
        foreach($goods as $g) {
            $g->thumbnail;
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
