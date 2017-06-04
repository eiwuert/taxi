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
        View::composer('admin.charts.fcm', 'App\Http\ViewComposers\FcmComposer');
        View::composer('admin.trips.index', 'App\Http\ViewComposers\TripComposer');
        View::composer('admin.clients.index', 'App\Http\ViewComposers\ClientComposer');
        View::composer('admin.payments.index', 'App\Http\ViewComposers\PaymentComposer');
        View::composer('admin.includes.sidebar', 'App\Http\ViewComposers\SidebarComposer');
        View::composer('admin.charts.flot-line', 'App\Http\ViewComposers\FlotLineComposer');
        View::composer('admin.components.clients', 'App\Http\ViewComposers\LatestClientsComposer');
        View::composer(['admin.drivers.index', 'admin.maps.*',], 'App\Http\ViewComposers\DriverComposer');
        View::composer('admin.components.googlemaps-marker', 'App\Http\ViewComposers\GoogleMapsMarkerComposer');
        View::composer('admin.components.googlemaps-circle', 'App\Http\ViewComposers\GoogleMapsCircleComposer');
        View::composer('admin.components.googlemaps-markers', 'App\Http\ViewComposers\GoogleMapsMarkersComposer');
        View::composer(['admin.includes.header', 'admin.includes.sidebar'], 'App\Http\ViewComposers\AdminHeaderComposer');
    }
}
