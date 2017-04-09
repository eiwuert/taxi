<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Illuminate\Support\Facades\Auth;

class InTrip
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->role == 'client') {
            $client = Auth::user()->client->first();
            $trip = $client->trips()->where('prev', null)->orderBy('id', 'desc')->first();
        } else {
            $driver = Auth::user()->driver()->first();
            $trip = $driver->trips()->orderBy('id', 'desc')->first();
        }
        if (is_null($trip)) {
            return fail([
                'title'  => __('api/trip.Not on trip'),
                'detail' => __('api/trip.Not on an active trip right now'),
            ]);
        }

        if (Auth::user()->role == 'client' &&
            // DRIVER_RATED
            $trip->status_id   ==  16) {
            return fail([
                'title'  => __('api/trip.Not on trip'),
                'detail' => __('api/trip.Not on an active trip right now'),
            ]);
        }

        if (Auth::user()->role == 'driver' &&
            // DRIVER_RATED
            $trip->status_id   ==  15) {
            return fail([
                'title'  => __('api/trip.Not on trip'),
                'detail' => __('api/trip.Not on an active trip right now'),
            ]);
        }

        if ($trip->status_id == 10 ||
            $trip->status_id == 5  ||
            $trip->status_id == 4  ||
            $trip->status_id == 11 ||
            $trip->status_id == 8  ||
            $trip->status_id == 13 ||
            $trip->status_id == 14 ||
            $trip->status_id == 17 ||
            $trip->status_id == 18 ||
            $trip->status_id == 3) {
            return fail([
                'title'  => __('api/trip.Not on trip'),
                'detail' => __('api/trip.Not on an active trip right now'),
            ]);
        } else {
            return $next($request);
        }
    }
}
