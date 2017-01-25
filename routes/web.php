<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::get('/', 'HomeController@index');
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('admin/login', 'Admin\AuthController@form')
    ->name('login');
Route::post('admin/login', 'Admin\AuthController@login');
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 
            'middleware' => ['auth', 'can:access', 'verified']], function() {
	Route::get('dashboard', 'DashboardController@index')
        ->name('dashboard');
    // DRIVERS
    require base_path('routes/admin/driver.php');
    // CLIENT
    require base_path('routes/admin/client.php');
    // TRIP
    require base_path('routes/admin/trip.php');
    // CAR
    Route::resource('cars', 'CarController');
    // MAP
    Route::get('maps', 'MapsController@index')
        ->name('maps.index');
    Route::get('maps/fullscreen', 'MapsController@fullscreen')
        ->name('maps.fullscreen');
    Route::get('maps/locations', 'MapsController@getDriversJson')
        ->name('getDriversJson');
    Route::get('maps/locations/{driver}', 'MapsController@getDriverJson')
        ->name('getDriverJson');
});

Route::get('/home', 'HomeController@index');
