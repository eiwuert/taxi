<?php

/**
 * Client Routes.
 */
Route::group(['prefix' => 'client', 'namespace' => 'V4'], function () {
    Route::group(['middleware' => ['auth:api', 'role:client', 'verified']], function () {
        Route::post('nearby', 'TripController@nearby');
    });
});
