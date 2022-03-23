<?php

namespace App\Listeners\Beds;

use App\Events\Beds\CreateBedsEvent;
use App\Models\Bed;
use App\Repositories\Beds\BedsRepositoryInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateBedsListener
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
     * @param  CreateBedsEvent  $event
     * @return void
     */
    public function handle(CreateBedsEvent $event)
    {
        $bedsCount = $event->bedCount;
        $roomId = $event->roomId;

        for ($x = 0; $x < $bedsCount; $x++) {
            Bed::create([
                'room_id'=> $roomId,
                'bed_number'=> $x+1,
                'assigned'=> false,
                'is_active'=> true,
            ]);
        }
    }
}
