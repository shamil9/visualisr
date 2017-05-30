<?php

namespace App\Events;

use App\Visual;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;

class VisualUpdateEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $visual;
    public $request;

    /**
     * Create a new event instance.
     *
     * @param Visual $visual
     */
    public function __construct(Visual $visual, Request $request)
    {
        $this->visual = $visual;
        $this->request = $request;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
