<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class IsSuperadmin
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
        if (Auth::user()->web->superadmin()) {
            return $next($request);
        } else {
            return redirect()->back();
        }
    }
}
