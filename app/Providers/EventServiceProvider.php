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
        // Visual events
        'App\Events\VisualUpdateEvent' => [
            'App\Listeners\VisualUpdateEventListener',
        ],
        'App\Events\VisualStoreEvent' => [
            'App\Listeners\VisualStoreEventListener',
        ],
        'App\Events\VisualDestroyEvent' => [
            'App\Listeners\VisualDestroyEventListener',
        ],
        // User events
        'App\Events\CreateUserEvent' => [
            'App\Listeners\CreateUserEventListener',
        ],
        // Comment Events
        'App\Events\CreateCommentEvent' => [
            'App\Listeners\CreateCommentEventListener'
        ]
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
