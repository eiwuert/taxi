<?php
/**
 * Payment related routes.
 */

Route::post('payment/charge', 'PaymentController@charge');
Route::get('payment/charge/{id}/{amount}', 'PaymentController@redirectCharge');
