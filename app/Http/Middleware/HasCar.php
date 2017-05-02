<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Factory as AuthFactory;

class HasCar
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
    public function handle($request, Closure $next)
    {
        if (! Auth::user()->car()->get()->isEmpty()) {
            return $next($request);
        } else {
            return fail([
                'title'  => __('admin/middleware.No car'),
                'detail' => __('admin/middleware.You should contact your area call center to register your car'),
            ], 401);
        }
    }
}
