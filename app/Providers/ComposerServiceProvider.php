<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            ['admin.includes.header',
            'admin.includes.sidebar'], 'App\Http\ViewComposers\AdminHeaderComposer'
        );

        View::composer(
            'admin.drivers.index', 'App\Http\ViewComposers\DriverComposer'
        );
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
