<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Factory as AuthFactory;

class CheckApproveDriver
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
        $driver = $this->auth->user()->driver()->first();
        if (!is_null($this->auth->user()->driver()->first()) && $driver->approve) {
            return $next($request);
        } else {
            return fail([
                'title'  => __('admin/middleware.Not an approved driver'),
                'detail' => __('admin/middleware.You should contact your area call center to begin approving process'),
            ], 401);
        }
    }
}
