<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class ReplacePhone
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
/*        if (! isset(User::where('phone', $request->username)->first()->email)) {
            return fail([
                    'title' => 'Unhandled error',
                    'detail'=> 'Unhandled error occured during issue token, please make sure you have entered username'
                ], 500);
        }

        $request['username'] = User::where('phone', $request->username)->first()->email;*/

        return $next($request);
    }
}
