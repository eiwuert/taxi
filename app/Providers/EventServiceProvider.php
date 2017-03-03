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
            'App\Listeners\NotifyAdmins',
        ],
        'App\Events\TripInitiated' => [
            'App\Listeners\IssueInvoice',
            'App\Listeners\CheckBalance',
        ],
        'App\Events\TripEnded' => [
            'App\Listeners\RateTrip',
        ],
        'App\Events\UserVerified' => [
            'App\Listeners\MultiRecordClient',
            //'App\Listeners\CreateDriverCar',
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
