<?php

namespace App\Listeners;

use App\Events\CreateCommentEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateCommentEventListener
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
     * @param  CreateCommentEvent  $event
     * @return void
     */
    public function handle(CreateCommentEvent $event)
    {
        //
    }
}
