<?php

namespace App\Listeners;

use App\Events\VisualStoreEvent;
use App\Services\Visual;

class VisualStoreEventListener
{
    /**
     * Handle the event.
     *
     * @param  VisualStoreEvent  $event
     * @return Exception|\Exception
     */
    public function handle(VisualStoreEvent $event)
    {
        $name = uniqid(str_slug($event->request->track, '-') . '-') . '.png';
        $event->visual->track = $event->request->track;
        $event->visual->user_id = auth()->user()->id;
        $event->visual->artist = $event->request->artist;
        $event->visual->album = $event->request->album;

        $visual = new Visual($event->request->image, $name);
        $visual->storeImage();

        $event->visual->image = $name;
        $event->visual->save();
    }
}
