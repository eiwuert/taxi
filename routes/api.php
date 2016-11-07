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
	Route::post('register', 'Auth\RegisterController@driver')->name('registerClient');
	Route::post('register/social', 'Auth\RegisterController@socialClient')->name('registerClientSocial');
	// login
	Route::post('login', 'Auth\LoginController@loginUser')->name('loginClient');
	Route::post('login/social', 'Auth\LoginController@loginSocial')->name('loginClientSocial');

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

		Route::get('profile', 'ProfileController@get');
		Route::post('profile', 'ProfileController@update');
	});
});

/**
 * Driver Routes.
 */
Route::group(['prefix' => 'driver'], function() {
	// Register
	Route::post('register', 'Auth\RegisterController@client')->name('registerDriver');
	Route::post('register/social', 'Auth\RegisterController@socialDriver')->name('registerDriverSocial');
	// Login
	Route::post('login', 'Auth\LoginController@loginUser')->name('loginDriver');
	Route::post('login/social', 'Auth\LoginController@loginSocial')->name('loginDriverSocial');

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

		Route::get('profile', 'ProfileController@get');
		Route::post('profile', 'ProfileController@update');
	});
});
