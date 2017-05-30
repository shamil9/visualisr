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
     * @param  VisualDestroyEvent $event
     * @return void
     */
    public function handle(VisualDestroyEvent $event)
    {
        $event->visual->delete();
        $dir = storage_path('app/public/visuals/' . $event->visual->user_id);
        unlink($dir . '/' . $event->visual->image);
        unlink($dir . '/thumb_' . $event->visual->image);
        unlink($dir . '/twitter_' . $event->visual->image);
        unlink($dir . '/fb_' . $event->visual->image);
    }
}
