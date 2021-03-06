<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \App\Http\Middleware\LogAfterRequest::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
            \App\Http\Middleware\UserLang::class,
        ],

        'api' => [
            'throttle:500,1',
            'bindings',
            'post.size',
            'log.req',
            'lang'
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'role'       => \App\Http\Middleware\CheckRole::class,
        'json'       => \App\Http\Middleware\FormatJson::class,
        'header'     => \App\Http\Middleware\CheckHeader::class,
        'can'        => \Illuminate\Auth\Middleware\Authorize::class,
        'verified'   => \App\Http\Middleware\CheckVerifiedUser::class,
        'approved'   => \App\Http\Middleware\CheckApproveDriver::class,
        'online'     => \App\Http\Middleware\CheckOnlineDriver::class,
        'hasCar'     => \App\Http\Middleware\HasCar::class,
        'auth'       => \App\Http\Middleware\Authenticate::class,
        'guest'      => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle'   => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'bindings'   => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'post.size'  => \App\Http\Middleware\ValidatePostSizeLimit::class,
        'log.req'    => \App\Http\Middleware\LogAfterRequest::class,
        'csrf'       => \App\Http\Middleware\VerifyCsrfToken::class,
        'inTrip'     => \App\Http\Middleware\InTrip::class,
        'notPaid'    => \App\Http\Middleware\NotPaid::class,
        'lang'       => \App\Http\Middleware\UserLang::class,
        'superadmin' => \App\Http\Middleware\IsSuperadmin::class,
        'states'     => \App\Http\Middleware\StatesPermission::class,
    ];
}
