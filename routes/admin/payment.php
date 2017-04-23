<?php
/**
 * Payment related routes.
 */

Route::get('payments/filter', 'PaymentController@filter')->name('payments.filter');
Route::get('payments/drivers', 'PaymentController@drivers')->name('payments.drivers');
Route::get('payments/drivers/{driver}/trips', 'PaymentController@trips')->name('payments.drivers.trips');
Route::get('payments/drivers/{driver}/trips/filter', 'PaymentController@filterTrips')->name('payments.drivers.trips.filter');
Route::resource('payments', 'PaymentController');
