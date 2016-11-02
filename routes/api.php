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
Route::group(['prefix' => 'client'], function() {
	// Register
	Route::post('register', 'ClientController@register')->name('registerClient');
	// login
	Route::post('login', 'ClientController@login')->name('loginClient');

	Route::group(['middleware' => 'auth:api'], function() {
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

	Route::group(['middleware' => 'auth:api'], function() {
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
