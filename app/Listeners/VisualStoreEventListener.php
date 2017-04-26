<?php

namespace App\Listeners;

use App\Events\VisualStoreEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class VisualStoreEventListener
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
     * @param  VisualStoreEvent  $event
     * @return void
     */
    public function handle(VisualStoreEvent $event)
    {
        $event->visual->track = $event->request->track;
        $event->visual->user_id = auth()->user()->id;
        $event->visual->artist = $event->request->artist;
        $event->visual->album = $event->request->album;
        $event->visual->image = $event->visual->user_id . uniqid($event->visual->track) . '.png';

        try {
            $dir = $this->createDir($event->visual->user_id);
            \Image::make($event->request->image)->save($dir . '/' . $event->visual->image);
            \Image::make($event->request->image)->resize(410, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($dir . '/' . 'thumb_' . $event->visual->image);
            \Image::make($event->request->image)->resize(1500, 500)->save($dir . '/' . 'twitter_' . $event->visual->image);
            \Image::make($event->request->image)->resize(828, 315)->save($dir . '/' . 'fb_' . $event->visual->image);
        } catch (Exception $e) {
            return $e;
        } finally {
            $event->visual->save();
        }
    }

    private function createDir(int $id)
    {
        $dir = public_path() . '/uploads/visuals/' . $id;
        try {
           \File::makeDirectory($dir);
        } finally {
            return $dir;
        }
    }
}
