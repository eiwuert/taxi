<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use App\User;

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
            $client = Auth::user()->client->first();
            $trip = $client->trips()->where('prev', null)->orderBy('id', 'desc')->first();
            if ($trip->payments()->exists()) {
                return fail([
                    'title'  => __('admin/middleware.You already paid'),
                    'detail' => __('admin/middleware.You paid your trip cost or cannot change payment method'),
                ]);
            } else {
                return $next($request);
            }
        }
    }
}
