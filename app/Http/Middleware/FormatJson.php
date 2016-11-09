<?php

namespace App\Http\Middleware;

use Closure;

class FormatJson
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
        $response = $next($request);
        if ($response->isOk()) {
            return ok(json_decode($response->getContent()));
        } else {
            return fail([
                'title'  => json_decode($response->getContent()),
                'detail' => 'You have entered email and password that can not be authenticated.'
            ], $response->getStatusCode());
        }

        return $response;
    }
}
