<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\UserRegistered' => [
            'App\Listeners\SendSMSVerification',
        ],
        'App\Events\RideAccepted' => [
            'App\Listeners\IssueInvoice',
        ],
        'App\Events\TripEnded' => [
            'App\Listeners\RateTrip',
        ],
        'App\Events\UserVerified' => [
            'App\Listeners\MultiRecordClient',
            'App\Listeners\MultiRecordDriver',
            'App\Listeners\RevokeOtherAccessToken',
        ],
        'Laravel\Passport\Events\AccessTokenCreated' => [
            /* */
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
