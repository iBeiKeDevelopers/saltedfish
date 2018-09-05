<?php

namespace App\Listeners;

use App\Events\GoodsBrowsedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class GoodsBrowsedListener
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
     * @param  GoodsBrowsedEvent  $event
     * @return void
     */
    public function handle(GoodsBrowsedEvent $event)
    {
        $browse = $event->browse;
        $browse->view++;
        $browse->save();
    }
}
