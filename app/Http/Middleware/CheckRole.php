<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Factory as AuthFactory;

class CheckRole
{
    /**
     * The authentication factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(AuthFactory $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role = 'client')
    {
        if ($role == 'client' && ! is_null($this->auth->guard('api')->user()->client()->first())) {
            return $next($request);
        } elseif ($role == 'driver' && ! is_null($this->auth->guard('api')->user()->driver()->first())) {
            return $next($request);
        } else {
            return fail([
                    'title'  => 'You are not authorized to access',
                    'detail' => 'You\'re not authorized to access this route of the application, please check your token privileges.'
                ], 401);
        }
    }
}
