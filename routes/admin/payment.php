<?php
/**
 * Payment related routes.
 */

Route::post('payment/charge', 'PaymentController@charge');
Route::get('payment/charge/{id}/{amount}', 'PaymentController@redirectCharge');
Route::get('payments/filter', 'PaymentController@filter')->name('payments.filter');
Route::resource('payments', 'PaymentController');
