<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
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
        return view('chat.index',[
            'id'        =>          $id,
        ]);
    }

    public function send(Request $request, $id) {
        $message = $request->input('message');
        if(!is_string($message))
            abort(400);
        broadcast(new Event([
            'message'   =>      $message,
            'from'      =>      Auth::id(),
            'to'        =>      $id,
        ]));
    }

    public function touch() {

    }

    public function push() {

    }

    public function load() {

    }
}
