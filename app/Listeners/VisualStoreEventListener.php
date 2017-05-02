<?php

namespace App\Listeners;

use App\Events\VisualStoreEvent;

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
     * @return Exception|\Exception
     */
    public function handle(VisualStoreEvent $event)
    {
        $event->visual->track = $event->request->track;
        $event->visual->user_id = auth()->user()->id;
        $event->visual->artist = $event->request->artist;
        $event->visual->album = $event->request->album;
        $event->visual->image = $event->visual->user_id . uniqid($event->visual->track) . '.png';

        try {
            $this->storeImage($event->request, $event->visual);
        } catch (\Exception $e) {
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

    public function storeImage($request, $visual)
    {
        $dir = $this->createDir($visual->user_id);

        // full size image
        \Image::make($request->image)
            ->save($dir . '/' . $visual->image);

        // thumbnail
        \Image::make($request->image)
            ->resize(410, null, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save($dir . '/' . 'thumb_' . $visual->image);

        // twitter banner
        \Image::make($request->image)
            ->resize(1500, 500)
            ->save($dir . '/' . 'twitter_' . $visual->image);

        //facebook banner
        \Image::make($request->image)
            ->resize(828, 315)
            ->save($dir . '/' . 'fb_' . $visual->image);
    }
}
