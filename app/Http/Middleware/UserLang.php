<?php

namespace App\Http\Middleware;

use App;
use Closure;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Factory as AuthFactory;

class UserLang
{
    /**
     * The authentication factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * The request instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $request;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(AuthFactory $auth, Request $request)
    {
        $this->auth = $auth;
        $this->request = $request;
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
        $user = $this->auth->guard('api')->user();
        if (is_null($user)) {
            // If we are on API registration step.
            $lang = $this->request->has('lang') 
                  ? $this->request->get('lang') 
                  : $this->request->segment(1);
            // Switch to segment 1 language or user defined language.
            $this->switch($lang);
        } else {
            // Switch to user (API) preselected language.
            $this->switch(call_user_func([$user, $user->role])->first()->lang);
        }
        return $next($request);
    }

    /**
     * Switch language to given language.
     *
     * @param  string $lang
     * @return void
     */
    private function switch($lang)
    {
        Carbon::setLocale($lang);
        App::setLocale($lang);
    }
}
