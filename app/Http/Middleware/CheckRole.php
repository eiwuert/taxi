<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
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
     * @param  string $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role = 'client')
    {
        if (is_null($this->auth->guard('api')->user()) ||
            is_null($this->auth->guard('api')->user()) ) {
            return fail([
                'title'  => __('admin/middleware.You are not authorized to access'),
                'detail' => __('admin/middleware.not authorized to access this route'),
            ], 401);
        }
        $role = $this->auth->guard('api')->user()->role;
        if (($role == 'client' && ! is_null($this->auth->guard('api')->user()->client()->first())) || 
            ($role == 'driver' && ! is_null($this->auth->guard('api')->user()->driver()->first()))) {
            return $next($request);
        } else {
            return fail([
                'title'  => __('admin/middleware.You are not authorized to access'),
                'detail' => __('admin/middleware.not authorized to access this route'),
            ], 401);
        }
    }
}
