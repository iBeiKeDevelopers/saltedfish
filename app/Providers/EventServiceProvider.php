<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\GoodsBrowsedEvent' => [
            'App\Listeners\GoodsBrowsedListener',
        ],
        'App\Events\Chat\MessageSendingEvent' => [
            'App\Listeners\Chat\MessageSentListener',
        ],
        'App\Events\OrderCreatedEvent' => [
            'App\Listeners\OrderCreatedListener',
        ],
        'App\Events\OrderCanceledEvent' => [
            'App\Listeners\OrderCanceledListener',
        ],
        'App\Events\OrderSendingEvent' => [
            'App\Listeners\OrderSendingListener',
        ],
        'App\Events\OrderShippedEvent' => [
            'App\Listeners\OrderShippedListener',
        ],
        'App\Events\OrderDeletedEvent' => [
            'App\Listeners\OrderDeletedListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
