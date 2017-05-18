<?php

use Illuminate\Http\Request;

/**
 * Client Routes.
 */
Route::group(['prefix' => 'client', 'namespace' => 'V3'], function () {
    Route::group(['middleware' => ['auth:api', 'role:client', 'verified']], function () {
        Route::post('calculate', 'TripController@calculate')
             ->name('calculateTrip');

        Route::post('nearby', 'TripController@nearbyTaxi')
             ->name('nearbyTaxiV3');
    });
});

