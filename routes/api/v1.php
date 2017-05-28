<?php

use Illuminate\Http\Request;


/**
 * Client Routes.
 */
Route::group(['prefix' => 'client', 'middleware' => 'header'], function () {
    Route::post('register', 'Auth\RegisterController@client')
         ->name('client.register');

    Route::get('states', 'StateController@active')
        ->name('client.states.active');

    Route::post('verify', 'Auth\SmsController@verify')
         ->name('client.verify')
         ->middleware('auth:api', 'role:client');

    Route::get('resend', 'Auth\SmsController@resend')
         ->name('client.sms.resend')
         ->middleware('auth:api', 'role:client');

    Route::get('lang/{lang}', 'UserController@changeLang')
        ->name('client.langs.change')
        ->middleware('auth:api');

    Route::get('contact', 'UserController@contact')
        ->name('client.contact')
        ->middleware('auth:api');

    Route::group(['middleware' => ['auth:api', 'role:client', 'verified']], function () {
        Route::post('location', 'Trip\LocationController@set')
             ->name('client.location.set');

        Route::get('car/types', 'Car\CarTypeController@all')
            ->name('client.cars.type');

        Route::get('profile', 'ProfileController@get')
             ->name('client.profiles.get');

        Route::get('balance', 'ProfileController@balance')
             ->name('client.balance');

        Route::post('profile', 'ProfileController@update')
             ->name('client.profiles.update');

        Route::post('trip', 'Trip\TripController@requestTaxi')
             ->name('client.trips.request');

        Route::post('calculate', 'Trip\TripController@calculate')
             ->name('client.trips.calculate');

        Route::post('nearby', 'Trip\TripController@nearbyTaxi')
             ->name('client.trips.nearbyTaxi');

        Route::get('cancel', 'Trip\TripController@cancel')
             ->name('client.trips.cancel');

        Route::get('trip', 'Trip\TripController@trip')
             ->name('client.trips.current')
             ->middleware('inTrip');

        Route::post('rate', 'Trip\RateController@client')
             ->name('client.trips.rate.set');

        Route::get('history', 'Trip\HistoryController@client')
             ->name('client.trips.history');

        Route::group(['middleware' => ['inTrip', 'notPaid']], function () {
            Route::get('pay/wallet', 'PaymentController@withWallet');
            Route::get('pay/cash', 'PaymentController@withCash');
        });
    });
});

/**
 * Driver Routes.
 */
Route::group(['prefix' => 'driver', 'middleware' => 'header'], function () {
    Route::post('register', 'Auth\RegisterController@driver')
         ->name('driver.register');

    Route::get('states', 'StateController@active')
        ->name('driver.states.active');

    Route::group(['middleware' => ['auth:api', 'role:driver', 'verified', 'approved', 'hasCar']], function () {
        Route::get('status', 'Trip\DriverController@status')
             ->name('driver.status');

        Route::get('online', 'Trip\DriverController@online')
             ->name('driver.online');

        Route::get('offline', 'Trip\DriverController@offline')
             ->name('driver.offline');

        Route::post('location', 'Trip\LocationController@set')
             ->name('driver.location.set');

        Route::get('car/info', 'Car\CarController@info')
             ->name('driver.cars.info');

        Route::get('profile', 'ProfileController@get')
             ->name('driver.profiles.get');

        Route::post('profile', 'ProfileController@updateDriver')
             ->name('driver.profiles.update');

        Route::get('income', 'ProfileController@income')
             ->name('driver.income');

        Route::get('history', 'Trip\HistoryController@driver')
             ->name('driver.trips.history');

        Route::group(['middleware' => 'online'], function () {
            Route::get('accept', 'Trip\TripController@accept')
                 ->name('driver.trips.accept');

            Route::get('arrived', 'Trip\TripController@arrived')
                 ->name('driver.trips.arrived');

            Route::get('start', 'Trip\TripController@start')
                 ->name('driver.trips.start');

            Route::get('end', 'Trip\TripController@end')
                 ->name('driver.trips.end');

            Route::get('cancel', 'Trip\TripController@cancel')
                 ->name('driver.trips.cancel');

            Route::get('trip', 'Trip\TripController@trip')
                 ->name('driver.trips.current')
                 ->middleware('inTrip');

            Route::post('rate', 'Trip\RateController@driver')
                 ->name('driver.trips.rate.set');
        });
    });

    Route::post('verify', 'Auth\SmsController@verify')
         ->name('driver.verify')
         ->middleware('auth:api', 'role:driver');

    Route::get('resend', 'Auth\SmsController@resend')
         ->name('driver.sms.resend')
         ->middleware('auth:api', 'role:driver');

    Route::get('lang/{lang}', 'UserController@changeLang')
        ->name('driver.langs.change')
        ->middleware('auth:api');

    Route::get('contact', 'UserController@contact')
        ->name('driver.contact')
        ->middleware('auth:api');
});

Route::any('{any}', function () {
    return fail([
            'title'  => 'Not found',
            'detail' => 'Requested route not found `' . url()->current() . '`',
        ], 404);
})->where('any', '.*');
