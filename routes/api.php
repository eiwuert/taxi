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
Route::post('password/reset', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::post('oauth/token', '\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken');

/**
 * Client Routes.
 */
Route::group(['prefix' => 'client'], function() {
	// Register
	Route::post('register', 'ClientController@register')->name('registerClient');
	// login
	Route::post('login', 'ClientController@login')->name('loginClient');

	Route::group(['middleware' => ['auth:api', 'role:client']], function() {
		// Set user given location.
		Route::post('location', 'LocationController@set')
			 ->name('setLocation');

		// Get location based on id.
		Route::get('location/{id}', 'LocationController@get')
			 ->name('getLocation');

		Route::group(['prefix' => 'car'], function() {
			// Get all car types.
			Route::get('types', 'CarTypeController@all');

			// Search car types.
			Route::get('search/{term}', 'CarTypeController@search');
		});
	});
});

/**
 * Driver Routes.
 */
Route::group(['prefix' => 'driver'], function() {
	// Register
	Route::post('register', 'DriverController@register')->name('registerDriver');
	// Login
	Route::post('login', 'DriverController@login')->name('loginDriver');

	Route::group(['middleware' => ['auth:api', 'role:driver']], function() {
		// Set user given location.
		Route::post('location', 'LocationController@set')
			 ->name('setLocation');

		// Get location based on id.
		Route::get('location/{id}', 'LocationController@get')
			 ->name('getLocation');

		Route::group(['prefix' => 'car'], function() {
			// Register new car
			Route::post('register', 'CarController@register');

			// Get driver car info
			Route::get('info', 'CarController@info');
		});
	});
});
