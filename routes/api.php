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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::get('/test', function (Request $request) {
	return dd($request->user());
})->middleware('auth:api');

// JWT AUTH
Route::post('location', 'LocationController@set')
	->name('setLocation')
	->middleware('auth:api');

Route::get('location', 'LocationController@get')
	->name('getLocation')
	->middleware('auth:api');

Route::group(['prefix' => 'client'], function() {
	Route::post('register', 'ClientController@register')
		 ->name('registerClient');
});

/*Route::get('/user/{user}', function (App\user $user) {
    return $user->email;
})->middleware('auth:api');*/
