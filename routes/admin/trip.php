<?php
/**
 * Routes for trips.
 */
Route::group(['prefix' => 'trips'], function () {
    Route::get('filter', 'TripController@filter')
        ->name('trips.filter');
    Route::get('search', 'TripController@search')
        ->name('trips.search');
    Route::get('cancel/{trip}', 'TripController@cancel')
        ->name('trips.hardCancel');
});
Route::resource('trips', 'TripController');
