<?php

namespace App\Events\Beds;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CreateBedsEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $roomId;
    public $bedCount;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($bedCount,$roomId)
    {
        $this->bedCount = $bedCount;
        $this->roomId = $roomId;
    }

}
