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
Route::group(['prefix' => 'client'], function() {
	Route::post('register', 'Auth\RegisterController@client')
		 ->name('registerClient');

	Route::post('register/social', 'Auth\RegisterController@socialClient')
		 ->name('registerClientSocial');

	Route::post('login', 'Auth\LoginController@loginUser')
		 ->name('loginClient');

	Route::post('login/social', 'Auth\LoginController@loginSocial')
		 ->name('loginClientSocial');

	Route::group(['middleware' => ['auth:api', 'role:client']], function() {
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
	});
});

/**
 * Driver Routes.
 */
Route::group(['prefix' => 'driver'], function() {
	Route::post('register', 'Auth\RegisterController@driver')
		 ->name('registerDriver');

	Route::post('login', 'Auth\LoginController@loginUser')
		 ->name('loginDriver');

	Route::group(['middleware' => ['auth:api', 'role:driver', 'approved']], function() {
		Route::get('online', 'DriverController@online')
			 ->name('goOnline');

		Route::get('offline', 'DriverController@offline')
			 ->name('goOffline');

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
	});
});
