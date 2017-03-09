<?php

namespace App\Http\Middleware;

use App\User;
use Auth;
use Closure;

class NotPaid
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
        if (Auth::user()->role == 'driver') {
            return $next($request);
        } else {
            $client = User::wherePhone(Auth::user()->phone)
                            ->orderBy('id', 'desc')
                            ->first()->client()->first();
            $trip = $client->trips()->where('prev', null)->orderBy('id', 'desc')->first();
            if ($trip->payments()->exists()) {
                return fail([
                    'title'  => 'You already paid',
                    'detail' => 'You paid your trip cost or cannot change payment method',
                ]);
            } else {
                return $next($request);
            }
        }
    }
}