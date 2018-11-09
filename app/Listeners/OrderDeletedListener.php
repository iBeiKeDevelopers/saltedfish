<?php

namespace App\Listeners;

use App\Events\OrderDeletedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderDeletedListener
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
     * @param  OrderDeletedEvent  $event
     * @return void
     */
    public function handle(OrderDeletedEvent $event)
    {
        $order = $event->order;
        $order->delete();
    }
}
