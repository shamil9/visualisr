<?php

namespace App\Listeners;

use App\Events\VisualDestroyEvent;
use Illuminate\Support\Facades\Storage;

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
        $dir = public_path() . '/uploads/visuals/' . $event->visual->user->id;
        Storage::deleteDirectory($dir);
    }
}
