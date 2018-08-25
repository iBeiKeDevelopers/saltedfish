<?php

namespace App\Http\Controllers\Resource;

use Auth;
use App\Models\Goods;
use App\Models\Image;
use App\Models\Comment;

use App\Http\Controllers\Controller;

use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

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
    public function index($id = 0)
    {
        if($id == Auth::id())
            return redirect('/goods');
        else if($id == 0)
            return view('goods.home');
        else
            return view('goods.index', [
                'id' => $id,
            ]);
    }

    public function category($cat = 'all')
    {
        switch($cat) {
            case 'all':
                $goods = 0;
            case '食品':
                return "aaa";
            default:
                return redirect('/goods/all');
        }

        return view('goods.index', [
            'goods'     =>      $goods,
            'thumbnail' =>      $goods->thumbnail,
        ]);
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
        return view('goods.form', [
            "id" => 0,
            "title" => "",
            "description" => "",
            "type" =>"",
            "cost" => 0,
            "remain" => 0,
            "cat1" => "",
            "cat2" => "",
            "tags" => null,
            "url" => "/goods",
            "list" => [],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $raw = $request->all();
        $message = isValid($raw);
        if($message === true) {
            $goods = [
                'title' => $raw['title'],
                'owner' => Auth::id(),
                'type' => $raw['type'],
                'cost' => $raw['cost'],
                'remain' => $raw['remain'],
                'description' => $raw['description'],
                'category' => "{cat1:'".$raw['cat1']."',cat2:'".$raw['cat2']."'}",
            ];
            $goodsModel = new Goods($goods);
            $goodsModel->save();
            $id = $goodsModel->id;
            
            if($id) {
                $dir = 'public/'.date('Y/M');
                foreach($raw['uploadList'] as $name) {
                    $content = Cache::pull($name);
                    Storage::put("public/tmp/$name.tmp", $content);
                    $path = Storage::putFile($dir, new File("./storage/tmp/$name.tmp"));

                    $res = Image::insert([
                        'gid'       =>      $id,
                        'src'       =>      $path,
                    ]);
                    if(!$res) return [
                        'status'    =>      false,
                        'error'     =>      'db error',
                    ];
                }

                return [
                    'status'    =>      true,
                    'id'        =>      $id,
                ];
            }else
                $message = 'db error';
        }
        
        return [
            'status'    =>      false,
            'error'     =>      $message,
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  integer      $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('goods.home',[
            'common'     =>      Goods::find($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param       integer      $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $goods = Goods::find($id);
        if(!$goods)
            abort(404);

        if($goods->owner != Auth::id())
            abort(403);

        $images = $goods->images;
        //return $images;

        $list = [];
        foreach($images as $img) {
            $key = uniqid();
            $content = Storage::get($img->src);
            cache([$key => $content], 30);
            array_push($list, [
                'url'       =>          Storage::url($img->src),
                'name'      =>          $key,
            ]);
        }
        $category = getCatIn($goods->category);
        $goods->list = $list;
        $goods->cat1 = $category[0];
        $goods->cat2 = $category[1];
        $goods->tags = '';
        $goods->url  = "/goods/$id";
        return view('goods.form', $goods);
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
        $goodsModel = Goods::find($id);
        $images = $goodsModel->images;
        foreach($images as $img) {
            $imgModel = Image::find($img->id);
            $imgModel->delete();
        }

        $raw = $request->all();
        $message = isValid($raw);
        if($message === true) {
            $goodsModel->title = $raw['title'];
            $goodsModel->owner = Auth::id();
            $goodsModel->type = $raw['type'];
            $goodsModel->cost = $raw['cost'];
            $goodsModel->remain = $raw['remain'];
            $goodsModel->description = $raw['description'];
            $goodsModel->category = "{cat1:'".$raw['cat1']."',cat2:'".$raw['cat2']."'}";
            
            $goodsModel->save();
            
            $dir = 'public/'.date('Y/M');
            foreach($raw['uploadList'] as $name) {
                $content = Cache::pull($name);
                Storage::put("public/tmp/$name.tmp", $content);
                $path = Storage::putFile($dir, new File("./storage/tmp/$name.tmp"));

                $res = Image::insert([
                    'gid'       =>      $id,
                    'src'       =>      $path,
                ]);
                if(!$res) return [
                    'status'    =>      false,
                    'error'     =>      'db error',
                ];
            }

            return [
                'status'    =>      true,
                'id'        =>      $id,
            ];
        }
        
        return [
            'status'    =>      false,
            'error'     =>      $message,
        ];
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

function isValid($goods) {
    if(!is_string($goods["title"]))
        return "title is not a string";
    else if(strlen($goods["title"]) > 20)
        return "title is no more than 20 letters";
    
    if(!is_string($goods["description"]))
        return "description is not a string";
    else if(strlen($goods["description"]) < 20
        || strlen($goods["description"]) > 256)
        return "description is no longer than 256 letters and no shorter than 20 letters";

    $arr_cat = [
        "shyp" => [
            "csyp","xxyp","rcyp","qtshyp",
        ],
        "xxyp" => [
            "xjjc","xbbj","fxzl","sjzz","cgyy","qtxxyp",
        ],
        "sp" => [
            "ls","tc","yp","qtsp",
        ],
        "fs" => [
            "fsxm","dzfz","gj","qtfs",
        ],
        "dzcp" => [
            "sj","dn","sjpj","dnpj","qtdzcp",
        ],
        "tyyp" => [
            "qlxg","jsqc","qttyyp",
        ],
        "yyqc" => [
            "xyyq","mzyq","yqpj","qtyyqc",
        ],
        "fstsp" => [
            "hpjh","bjzby","sy","pmsj","rjsj","spjj","pxkc","qtfstsp",
        ],
    ];

    if(!isset($arr_cat[$goods["cat1"]]) || !in_array($goods["cat2"], $arr_cat[$goods["cat1"]]))
        return "category does not exist";

    if(!is_numeric($goods["remain"]))
        return "remain is not a number";

    if(!is_numeric($goods["cost"]))
        return "cost is not a number";

        if(!is_numeric($goods["type"]))
        return "type is not in format";

    //todo: tags
    return true;
}

function getCatIn($string) {
    $start = strpos($string, ':');
    $end = strpos($string, ',');
    $len = $end - $start - 3;
    $cat1 = substr($string, $start+2, $len);
    $start = strrpos($string, ':');
    $end = strrpos($string, '}');
    $len = $end - $start - 3;
    $cat2 = substr($string, $start+2, $len);
    return [
        $cat1,
        $cat2,
    ];
}