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
 * Client Routes.
 */

Route::get('fcm', function() {
	return dispatch(new \App\Jobs\SendDriverNotification('test', 'test test', 'cVWr22bihRw:APA91bEFdsQvTcUMVDv77Tt-YJZHsWC4eHjj1WOJuy7g-2qOoeGjOPD8qNnvc4oE_aaxk9LXBnfZBZ53Jl_SYTJDCPl6upolKfY4SN5Mpw3uBhYVDkVObDrIzlFOkGrv3qv7a6WFDE2A'));
});

Route::group(['prefix' => 'client', 'middleware' => 'header'], function() {
	Route::post('register', 'Auth\RegisterController@client')
		 ->name('registerClient');

	Route::post('verify', 'Auth\SmsController@verify')
		 ->name('verifyUser')
		 ->middleware('auth:api', 'role:client');

	Route::get('resend', 'Auth\SmsController@resend')
		 ->name('resendSMS')
		 ->middleware('auth:api', 'role:client');

	Route::group(['middleware' => ['auth:api', 'role:client', 'verified']], function() {
		Route::post('location', 'Trip\LocationController@set')
		 	 ->name('setLocation');

		Route::get('car/types', 'Car\CarTypeController@all')
		 	->name('carTypes');

		Route::get('profile', 'ProfileController@get')
			 ->name('getClientProfile');

		Route::post('profile', 'ProfileController@update')
			 ->name('updateClientProfile');

		Route::post('trip', 'Trip\TripController@requestTaxi')
			 ->name('requestTaxi');

		Route::post('nearby', 'Trip\TripController@nearbyTaxi')
			 ->name('nearbyTaxi');

		Route::get('cancel', 'Trip\TripController@cancel')
			 ->name('clientCancelTrip');

		Route::get('trip', 'Trip\TripController@trip')
			 ->name('currentTrip');

		Route::post('rate', 'Trip\RateController@client')
			 ->name('clientRate');

		Route::get('history', 'Trip\HistoryController@client')
			 ->name('clientHistory');
	});
});

/**
 * Driver Routes.
 */
Route::group(['prefix' => 'driver', 'middleware' => 'header'], function() {
	Route::post('register', 'Auth\RegisterController@driver')
		 ->name('registerDriver');

	Route::group(['middleware' => ['auth:api', 'role:driver', 'verified', 'approved', 'hasCar']], function() {
		Route::get('online', 'Trip\DriverController@online')
			 ->name('goOnline');

		Route::get('offline', 'Trip\DriverController@offline')
			 ->name('goOffline');

		Route::post('location', 'Trip\LocationController@set')
			 ->name('setLocation');

		Route::get('car/info', 'Car\CarController@info')
			 ->name('getCarInfo');

		Route::get('profile', 'ProfileController@get')
			 ->name('getDriverProfile');

		Route::get('history', 'Trip\HistoryController@driver')
			 ->name('driverHistory');

		Route::group(['middleware' => 'online'], function() {
			Route::get('accept', 'Trip\TripController@accept')
				 ->name('driverAcceptTrip');

			Route::get('arrived', 'Trip\TripController@arrived')
				 ->name('driverArrived');

			Route::get('start', 'Trip\TripController@start')
				 ->name('driverStartTrip');

			Route::get('end', 'Trip\TripController@end')
				 ->name('driverEndTrip');

			Route::get('cancel', 'Trip\TripController@cancel')
				 ->name('driverCancelTrip');

			Route::get('trip', 'Trip\TripController@trip')
				 ->name('currentTrip');

			Route::post('rate', 'Trip\RateController@driver')
				 ->name('driverRate');
		});
	});

	Route::post('verify', 'Auth\SmsController@verify')
		 ->name('verifyUser')
		 ->middleware('auth:api', 'role:driver');

	Route::get('resend', 'Auth\SmsController@resend')
		 ->name('resendSMS')
		 ->middleware('auth:api', 'role:driver');
});

Route::any('{any}', function() {
	return fail([
			'title'  => 'Not found',
			'detail' => 'Requested route not found',
		], 404);
})->where('any', '.*');
