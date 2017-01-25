<?php
/**
 * Routes for trips.
 */
Route::group(['prefix' => 'trips'], function() {
    Route::get('filter', 'TripController@filter')
        ->name('trips.filter');
    Route::get('search', 'TripController@search')
        ->name('trips.search');
});
Route::resource('trips', 'TripController');