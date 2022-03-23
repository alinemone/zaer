<?php

namespace App\Providers;

use App\Models\AllocatedBed;
use App\Models\Bed;
use App\Providers\ReserveIsSuccessfully;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MarkBedToAssigned
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
     * @param ReserveIsSuccessfully $event
     * @return void
     */
    public function handle(ReserveIsSuccessfully $event)
    {
        $allocatedBed = $event->allocatedBed;

        Bed::where(Bed::ID, $allocatedBed->{AllocatedBed::BED_ID})->update([
            Bed::ASSIGNED => true
        ]);
    }
}
