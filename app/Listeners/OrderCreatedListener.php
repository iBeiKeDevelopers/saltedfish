<?php

namespace App\Listeners;

use App\Models\Goods;
use App\Events\OrderCreatedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderCreatedListener
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
     * @param  OrderCreatedEvent  $event
     * @return void
     */
    public function handle(OrderCreatedEvent $event)
    {
        $order = $event->order;
        $goods = Goods::findOrFail($order->gid);
        if((int)$goods->remain >= (int)$order->amount) {
            $goods->remain -= (int)$order->amount;
            $goods->save();
        }else {
            abort(403, 'Too much than remain!');
        }
    }
}
