<?php

namespace App\Providers;

use App\Sms;
use App\Rate;
use App\Driver;
use Carbon\Carbon;
use App\Policies\SmsPolicy;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Sms::class  => SmsPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Passport::routes();

        Passport::tokensExpireIn(Carbon::now()->addDays(1500));

        Passport::refreshTokensExpireIn(Carbon::now()->addDays(30));

        Gate::define('verify', function ($user) {
            return $user->verified == false;
        });

        Gate::define('client', function ($user, $trip) {
            return
            (
                (Driver::whereId($trip->driver_id)->first()->id === $trip->driver_id) &&
                (is_null($trip->rate()->first()->client) ) && 
                ( ($trip->status_id == 9) || ($trip->status_id == 15) )
            );
        });

        Gate::define('driver', function ($user, $trip) {
            return
            (
                (Driver::whereId($trip->driver_id)->first()->id === $trip->driver_id) &&
                (is_null($trip->rate()->first()->driver) ) && 
                ( ($trip->status_id == 9) || ($trip->status_id == 16) )
            );
        });
    }
}
