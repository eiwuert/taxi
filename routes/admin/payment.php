<?php
/**
 * Payment related routes.
 */

Route::post('payment/charge', 'PaymentController@charge');
Route::get('payment/charge/{id}/{amount}', 'PaymentController@redirectCharge');
Route::get('payments/filter', 'PaymentController@filter')->name('payments.filter');
Route::get('payments/drivers', 'PaymentController@drivers')->name('payments.drivers');
Route::get('payments/drivers/{driver}/trips', 'PaymentController@trips')->name('payments.drivers.trips');
Route::resource('payments', 'PaymentController');
