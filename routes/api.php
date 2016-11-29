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
Route::post('password/reset', 'Auth\ForgotPasswordController@sendResetLinkEmail')
	 ->name('resetPassword');

Route::post('oauth/token', '\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken')
	 ->middleware('format', 'json')
	 ->name('issueToken');

/**
 * Client Routes.
 */
Route::group(['prefix' => 'client', 'middleware' => 'header'], function() {
	Route::post('register', 'Auth\RegisterController@client')
		 ->name('registerClient');

	Route::post('register/social', 'Auth\RegisterController@socialClient')
		 ->name('registerClientSocial');

	Route::post('login', 'Auth\LoginController@loginUser')
		 ->name('loginClient');

	Route::post('login/social', 'Auth\LoginController@loginSocial')
		 ->name('loginClientSocial');

	Route::post('verify', 'SmsController@verify')
		 ->name('verifyUser')
		 ->middleware('auth:api', 'role:client');

	Route::post('resend', 'SmsController@resend')
		 ->name('resendSMS')
		 ->middleware('auth:api', 'role:client');

	Route::group(['middleware' => ['auth:api', 'role:client', 'verified']], function() {
		Route::post('location', 'LocationController@set')
		 	 ->name('setLocation');

		Route::get('location/{id}', 'LocationController@get')
			 ->name('getLocation');

		Route::group(['prefix' => 'car'], function() {
			Route::get('types', 'CarTypeController@all')
			 	->name('carTypes');

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
	});
});

/**
 * Driver Routes.
 */
Route::group(['prefix' => 'driver', 'middleware' => 'header'], function() {
	Route::post('register', 'Auth\RegisterController@driver')
		 ->name('registerDriver');

	Route::post('login', 'Auth\LoginController@loginUser')
		 ->name('loginDriver');

	Route::group(['middleware' => ['auth:api', 'role:driver', 'approved', 'verified']], function() {
		Route::get('online', 'DriverController@online')
			 ->name('goOnline');

		Route::get('offline', 'DriverController@offline')
			 ->name('goOffline');

		Route::get('onway', 'DriverController@onway')
			 ->name('goOnway');

		Route::get('available', 'DriverController@available')
			 ->name('goAvailable');

		Route::post('location', 'LocationController@set')
			 ->name('setLocation');

		Route::get('location/{id}', 'LocationController@get')
			 ->name('getLocation');

		Route::group(['prefix' => 'car'], function() {
			Route::post('register', 'CarController@register')
				 ->name('registerCar');

			Route::get('info', 'CarController@info')
				 ->name('getCarInfo');
		});

		Route::get('profile', 'ProfileController@get')
			 ->name('getDriverProfile');

		Route::post('profile', 'ProfileController@update')
			 ->name('updateDriverProfile');

		Route::get('cancel', 'TripController@cencel')
			 ->name('driverCancelTrip');

		Route::get('accept', 'TripController@accept')
			 ->name('driverAcceptTrip');

		Route::get('start', 'TripController@start')
			 ->name('driverStartTrip');
	});

	Route::post('verify', 'SmsController@verify')
		 ->name('verifyUser')
		 ->middleware('auth:api', 'role:driver');

	Route::post('resend', 'SmsController@resend')
		 ->name('resendSMS')
		 ->middleware('auth:api', 'role:driver');
});
