<?php
/**
 * Map related routes
 */
Route::get('maps', 'MapsController@index')
    ->name('maps.index');
Route::get('maps/fullscreen', 'MapsController@fullscreen')
    ->name('maps.fullscreen');
Route::get('maps/track/{driver}', 'MapsController@track')
    ->name('maps.track');
Route::get('maps/locations', 'MapsController@getDriversJson')
    ->name('getDriversJson');
Route::get('maps/location/{driver}', 'MapsController@getDriverJson')
    ->name('getDriverJson');
Route::get('maps/locations/{driver}', 'MapsController@getDriverJson')
    ->name('getDriverJson');
