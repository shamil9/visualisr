<?php

namespace App\Listeners;

use App\Events\VisualDestroyEvent;

class VisualDestroyEventListener
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
     * @param  VisualDestroyEvent  $event
     * @return void
     */
    public function handle(VisualDestroyEvent $event)
    {
        $event->visual->delete();
        $id = auth()->user()->id;
        unlink(public_path() . '/uploads/visuals/' . $id);
    }
}
