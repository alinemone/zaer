<?php

namespace App\Providers;

use App\Events\Beds\CreateBedsEvent;
use Illuminate\Auth\Events\Registered;
use App\Listeners\Beds\CreateBedsListener;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class            => [
            SendEmailVerificationNotification::class,
        ],
        CreateBedsEvent::class       => [
            CreateBedsListener::class
        ],
        ReserveIsSuccessfully::class => [
            MarkBedToAssigned::class
        ],
        BedIsClearanced::class       => [
            MarkBedToUnassigned::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
