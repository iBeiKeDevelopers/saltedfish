<?php

namespace App\Listeners;

use App\Events\OrderSendingEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderSendingListener
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
     * @param  OrderSendingEvent  $event
     * @return void
     */
    public function handle(OrderSendingEvent $event)
    {
        $order = $event->order;
        
        if($order->status == 0) {
            $order->status++;
            $order->save();
        }
    }
}
