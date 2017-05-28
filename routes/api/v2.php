<?php

use Illuminate\Http\Request;

/**
 * Client Routes.
 */

Route::group(['prefix' => 'client', 'middleware' => 'header', 'namespace' => 'V2\Trip'], function () {
    Route::group(['middleware' => ['auth:api', 'role:client', 'verified']], function () {
        Route::post('location', 'LocationController@set')
             ->name('setClientLocationV2');

        Route::post('trip', 'TripController@requestTaxi')
             ->name('requestTaxiV2');

        Route::post('calculate', 'TripController@calculate')
             ->name('calculateTripV2');

        Route::post('nearby', 'TripController@nearbyTaxi')
             ->name('nearbyTaxiV2');
    });
});

/**
 * Driver Routes.
 */
Route::group(['prefix' => 'driver', 'middleware' => 'header', 'namespace' => 'V2\Trip'], function () {
    Route::group(['middleware' => ['auth:api', 'role:driver', 'verified', 'approved', 'hasCar']], function () {
        Route::post('location', 'LocationController@set')
             ->name('setDriverLocationV2');
        Route::get('online', 'DriverController@online')
             ->name('goOnlineV2');
        Route::get('offline', 'DriverController@offline')
             ->name('goOfflineV2');
        Route::get('status', 'DriverController@status')
             ->name('getStatusV2');
        Route::group(['middleware' => 'online'], function () {
            Route::get('trip', 'TripController@trip')
                 ->middleware('inTrip');
        });
    });
});

Route::any('{any}', function () {
    return fail([
            'title'  => 'Not found',
            'detail' => 'Requested route not found',
        ], 404);
})->where('any', '.*');
