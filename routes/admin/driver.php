<?php
/**
 * Routes for drivers.
 */
Route::group(['prefix' => 'drivers'], function() {
    Route::get('filter', 'DriverController@filter')
        ->name('drivers.filter');
    Route::get('search', 'DriverController@search')
        ->name('drivers.search');
    Route::post('offline/{driver}', 'DriverController@offline')
        ->name('drivers.offline');
    Route::post('approve/{driver}', 'DriverController@approve')
        ->name('drivers.approve');
    Route::post('decline/{driver}', 'DriverController@decline')
        ->name('drivers.decline');
});
Route::resource('drivers', 'DriverController');