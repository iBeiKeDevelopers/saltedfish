<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Goods;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function submit(Request $request) {
        $raw = $request->input();
        if(!isset($raw['content']) || !isset($raw['id']))
            abort(402);

        $gid = $raw['id'];
        $content = $raw['content'];

        if(!is_string($content))
            return [
                'status'    =>      false,
                'error'     =>      'wtf are you uploading?!',
            ];
        
        if(strlen($content) > 90)
            return [
                'status'    =>      false,
                'error'     =>      '内容过长！',
            ];
        
        if(!is_numeric($gid))
            return [
                'status'    =>      false,
                'error'     =>      '非法数字!',
            ];

        if(!Goods::find($gid))
            return [
                'status'    =>      false,
                'error'     =>      '商品不存在!',
            ];
        
            $user = Auth::user();
        
        $res = Comment::create([
            'avatar'        =>      $user->avatar ?? '/storage/null.png',
            'content'       =>      $content,
            'gid'           =>      $gid,
            'uid'           =>      $user->id,
            'uname'         =>      $user->nick_name,
        ]);

        if($res)
            return ['status' => true];
        else
            abort(500);
    }
}
