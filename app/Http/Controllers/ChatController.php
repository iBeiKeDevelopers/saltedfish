<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Models\History;
use App\Events\Chat\MessageSendingEvent as Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class ChatController extends Controller
{
    private $room_key;

    //using cache
    //using websocket
    public function __construct() {
        $this->middleware('auth');
    }

    public function index($id) {
        if($id == Auth::id() || !User::find($id))
            abort(404);
        return view('chat',[
            'id'        =>          $id,
        ]);
    }

    public function sendMessageto(Request $request, $id)
    {
        $message = $request->input('message');
        if(!is_string($message))
            abort(400, "message not string!");
        if(strlen($message) > 100)
            abort(400, "too long!");
        
        event(new Event([
            'message'   =>      $message,
            'type'      =>      'text',
            'from'      =>      Auth::id(),
            'to'        =>      $id,
        ]));
    }

    public function sendImage(Request $request, $id)
    {
        $image = $zrequest->file('image');
        if(!$image)
            abort(400, "nothing!");

        $key = uniqid('image_');
        // 60 * 24 * 3
        // 3 days
        cache([$key => $image], 4320);
        
        event(new Event([
            'message'   =>      $path,
            'type'      =>      'image',
            'from'      =>      Auth::id(),
            'to'        =>      $id,
        ]));
    }

    public function sendFile(Request $request, $id)
    {
        $file = $zrequest->file('file');
        if(!$file)
            abort(400, "nothing!");

        $key = uniqid('file_');
        // 60 * 24 * 3
        // 3 days
        cache([$key => $file], 4320);
        
        event(new Event([
            'message'   =>      $key,
            'type'      =>      'file',
            'from'      =>      Auth::id(),
            'to'        =>      $id,
        ]));

    }

    public function showHistory($id) {
        $me = Auth::id();
        if($id == $me)
            abort(404);
        
        return [
            'received'  =>      History::where('from', $id)->where('to', $me)->get(),
            'sent'      =>      History::where('from', $me)->where('to', $id)->get(),
        ];
    }
}
