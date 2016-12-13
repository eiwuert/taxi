<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * General Routes.
 */
// DEPRECATE
Route::post('password/reset', 'Auth\ForgotPasswordController@sendResetLinkEmail')
	 ->name('resetPassword');

Route::post('oauth/token', '\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken')
	 //->middleware('format', 'json')
	 ->name('issueToken');

/**
 * Client Routes.
 */
Route::group(['prefix' => 'client', 'middleware' => 'header'], function() {
	Route::post('register', 'Auth\RegisterController@client')
		 ->name('registerClient');

	Route::post('verify', 'SmsController@verify')
		 ->name('verifyUser')
		 ->middleware('auth:api', 'role:client');

	Route::get('resend', 'SmsController@resend')
		 ->name('resendSMS')
		 ->middleware('auth:api', 'role:client');

	Route::group(['middleware' => ['auth:api', 'role:client', 'verified']], function() {
		Route::post('location', 'LocationController@set')
		 	 ->name('setLocation');

		// DEPRECATE
		Route::get('location/{id}', 'LocationController@get')
			 ->name('getLocation');

		Route::group(['prefix' => 'car'], function() {
			Route::get('types', 'CarTypeController@all')
			 	->name('carTypes');

			// DEPRECATE
			Route::get('search/{term}', 'CarTypeController@search')
			 	 ->name('searchCarTypes');
		});

		Route::get('profile', 'ProfileController@get')
			 ->name('getClientProfile');

		Route::post('profile', 'ProfileController@update')
			 ->name('updateClientProfile');

		Route::post('trip', 'TripController@requestTaxi')
			 ->name('requestTaxi');

		Route::post('nearby', 'TripController@nearbyTaxi')
			 ->name('nearbyTaxi');

		Route::get('cancel', 'TripController@cancel')
			 ->name('clientCancelTrip');

		Route::get('trip', 'TripController@trip')
			 ->name('currentTrip');

		Route::post('rate', 'RateController@client')
			 ->name('clientRate');
	});
});

/**
 * Driver Routes.
 */
Route::group(['prefix' => 'driver', 'middleware' => 'header'], function() {
	Route::post('register', 'Auth\RegisterController@driver')
		 ->name('registerDriver');

	Route::group(['middleware' => ['auth:api', 'role:driver', 'hasCar', 'approved', 'verified']], function() {
		Route::get('online', 'DriverController@online')
			 ->name('goOnline');

		Route::get('offline', 'DriverController@offline')
			 ->name('goOffline');

		Route::post('location', 'LocationController@set')
			 ->name('setLocation');

		Route::group(['prefix' => 'car'], function() {
			Route::get('info', 'CarController@info')
				 ->name('getCarInfo');
		});

		Route::get('profile', 'ProfileController@get')
			 ->name('getDriverProfile');

		// DEPRECATE
		Route::post('profile', 'ProfileController@update')
			 ->name('updateDriverProfile');

		Route::group(['middleware' => 'online'], function() {
			Route::get('cancel', 'TripController@cancel')
				 ->name('driverCancelTrip');

			Route::get('accept', 'TripController@accept')
				 ->name('driverAcceptTrip');

			Route::get('start', 'TripController@start')
				 ->name('driverStartTrip');

			Route::get('arrived', 'TripController@arrived')
				 ->name('driverArrived');

			Route::get('end', 'TripController@end')
				 ->name('driverEndTrip');

			Route::get('trip', 'TripController@trip')
				 ->name('currentTrip');

			Route::post('rate', 'RateController@driver')
				 ->name('driverRate');
		});
	});

	Route::post('verify', 'SmsController@verify')
		 ->name('verifyUser')
		 ->middleware('auth:api', 'role:driver');

	Route::get('resend', 'SmsController@resend')
		 ->name('resendSMS')
		 ->middleware('auth:api', 'role:driver');
});
