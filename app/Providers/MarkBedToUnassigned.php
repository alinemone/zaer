<?php

namespace App\Providers;

use App\Models\AllocatedBed;
use App\Models\Bed;
use App\Providers\BedIsClearanced;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MarkBedToUnassigned
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
     * @param BedIsClearanced $event
     * @return void
     */
    public function handle(BedIsClearanced $event)
    {
        $allocatedBed = $event->allocatedBed;
        
        Bed::where(Bed::ID, $allocatedBed->{AllocatedBed::BED_ID})
            ->update([
                Bed::ASSIGNED => false
            ]);
    }
}
