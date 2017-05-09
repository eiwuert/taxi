<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class StatesPermission
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
        if (in_array($request->state, Auth::user()->web->permissions) || 
            in_array('0', Auth::user()->web->permissions)) {
            return $next($request);
        } else {
            abort(403, 'Unauthorized action.');
        }
    }
}
