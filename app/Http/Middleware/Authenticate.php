<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Auth;

class Authenticate extends Auth
{
    /**
     * Determine if the user is logged in to any of the given guards.
     *
     * @param  array  $guards
     * @return void
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    protected function authenticate(array $guards)
    {
        if (empty($guards)) {
            return $this->auth->authenticate();
        }

        foreach ($guards as $guard) {
            if ($this->auth->guard($guard)->check()) {
                return $this->auth->shouldUse($guard);
            }
        }
        return fail([
            'title'  => __('admin/middleware.Unauthenticated'),
            'detail' => __('admin/middleware.Unauthenticated access token'),
            'status' => 403
        ]);

        //throw new AuthenticationException('...', $guards);
    }
}
