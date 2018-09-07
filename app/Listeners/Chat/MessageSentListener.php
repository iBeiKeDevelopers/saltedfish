<?php

namespace App\Listeners\Chat;

use App\Models\History;
use App\Events\Chat\MessageSendingEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MessageSentListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  MessageSendingEvent  $event
     * @return void
     */
    public function handle(MessageSendingEvent $event)
    {
        History::create([
            'content'   =>      $event->message,
            'type'      =>      $event->type,
            'from'      =>      $event->from,
            'to'        =>      $event->to,
        ]);
    }
}
