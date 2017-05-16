<?php

namespace App\Listeners;

use App\Events\VisualStoreEvent;

class VisualStoreEventListener
{
    private $date;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

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

        $this->storeImage($event->request, $event->visual, $name);

        $event->visual->image = $name;
        $event->visual->save();
    }

    public function createDirectory($dir)
    {
        try {
           \File::makeDirectory($dir, 0755, true);
        } finally {
            return $dir;
        }
    }

    public function storeImage($request, $visual, $name)
    {
        $dir = storage_path('app/public/visuals/' . $visual->user_id . '/' . $this->date);
        $this->createDirectory($dir);
        $image = \Image::make($request->image);

        // full size image
        $image->save($dir . '/' . $name);

        // thumbnail
        $image->resize(410, null, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save($dir . '/' . 'thumb_' . $name);

        // twitter banner
        $image->resize(1500, 500)
            ->save($dir . '/' . 'twitter_' . $name);

        //facebook banner
        $image->resize(828, 315)
            ->save($dir . '/' . 'fb_' . $name);
    }
}
