<?php

namespace App\Listeners;

use App\Events\VisualUpdateEvent;

class VisualUpdateEventListener
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
     * @param  VisualUpdateEvent $event
     * @return void
     */
    public function handle(VisualUpdateEvent $event)
    {
        $event->visual->track = $event->request->track;
        $event->visual->album = $event->request->album;
        $event->visual->artist = $event->request->artist;
        $event->visual->private = $event->request->private || 0;

        $event->visual->saveOrFail();
    }
}
