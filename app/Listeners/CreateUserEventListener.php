<?php

namespace App\Listeners;

use App\Events\CreateUserEvent;

class CreateUserEventListener
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
     * @param  CreateUserEvent $event
     * @return void
     */
    public function handle(CreateUserEvent $event)
    {
        //
    }
}
