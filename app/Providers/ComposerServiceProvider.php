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
            ['admin.drivers.index',
            'admin.maps.*',], 'App\Http\ViewComposers\DriverComposer'
        );

        View::composer(
            'admin.clients.index', 'App\Http\ViewComposers\ClientComposer'
        );

        View::composer(
            'admin.trips.index', 'App\Http\ViewComposers\TripComposer'
        );

        View::composer(
            'admin.components.googlemaps-markers', 'App\Http\ViewComposers\GoogleMapsMarkersComposer'
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
