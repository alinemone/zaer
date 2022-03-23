<?php

namespace App\Providers;

use App\Models\AllocatedBed;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class ReserveIsSuccessfully
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var AllocatedBed $allocatedBed */
    public $allocatedBed;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($allocatedBed)
    {
        $this->allocatedBed = $allocatedBed;
    }

}
