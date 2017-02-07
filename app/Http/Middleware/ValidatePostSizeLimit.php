<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\ValidatePostSize;

class ValidatePostSizeLimit extends ValidatePostSize
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
        $max = $this->getPostMaxSize();

        if ($max > 0 && $request->server('CONTENT_LENGTH') > $max) {
            return fail([
                    'title'  => 'Exceed file size',
                    'detail' => 'Post size exceed allowed size'
                ]);
        }

        return $next($request);
    }
}
