<?php

namespace App\Listeners;

use App\Events\VisualDestroyEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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
        $this->deleteImages($event->visual);
        $event->visual->delete();
    }

    public function deleteImages($visual)
    {
        $id = auth()->user()->id;
        unlink(public_path() . '/uploads/visuals/' . $id . '/' . $visual->image);
        unlink(public_path() . '/uploads/visuals/' . $id . '/twitter_' . $visual->image);
        unlink(public_path() . '/uploads/visuals/' . $id . '/thumb_' . $visual->image);
    }
}
