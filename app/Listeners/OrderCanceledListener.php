<?php

namespace App\Listeners;

use App\Events\OrderCanceledEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderCanceledListener
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
     * @param  OrderCanceledEvent  $event
     * @return void
     */
    public function handle(OrderCanceledEvent $event)
    {
        $order = $event->order;
        if($order->status != 3) {
            $order->status = 4;
            $order->save();
        }
    }
}
