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

Route::group(['prefix' => 'client'], function() {
	Route::post('register', 'ClientController@register')->name('registerClient');

	Route::group(['middleware' => 'auth:api'], function() {
		Route::post('location', 'LocationController@set')
			 ->name('setLocation');
		Route::get('location/{id}', 'LocationController@get')
			 ->name('getLocation');
	});

	Route::get('map', function() {
		$response = \GoogleMaps::load('geocoding')
				               ->setParamByKey('latlng', '35.757898,51.409714') 
				               ->get('results.formatted_address')['results'][0]['formatted_address'];
	    return $response;
	});
});
