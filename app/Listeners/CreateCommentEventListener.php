<?php

namespace App\Listeners;

use App\Events\CreateCommentEvent;
use App\Mail\CommentCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
        $comment = $event->visual->comments()->create([
            'user_id'   => auth()->id(),
            'visual_id' => $event->visual->id,
            'body'      => $event->request->body,
        ]);

        \Mail::to($event->visual->user->email)->send(new CommentCreated($comment));
    }
}
