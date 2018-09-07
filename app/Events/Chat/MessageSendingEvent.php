<?php

namespace App\Events\Chat;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MessageSendingEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    public $type;

    public $from;

    public $to;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($arr)
    {
        if(!isset($arr['message'])) abort(500, "message missing");
        if(!isset($arr['type'])) abort(500, "message type missing");
        if(!isset($arr['to']) || !isset($arr['from'])) abort(500, "user missing");

        $this->message = $arr['message'];
        $this->type = $arr['type'];
        $this->from = $arr['from'];
        $this->to = $arr['to'];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('App.Chat.'.$this->to);
    }

    public function broadcastAs()
    {
        return "message.from.".$this->from;
    }
}
