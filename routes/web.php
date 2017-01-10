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
Route::get('hash', function() {
    return \Hash::make(123456);
});

Route::get('/', function () {
    return view('welcome');
});

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
    Route::get('drivers/filter', 'DriverController@status')
        ->name('driverFilter');
    Route::get('drivers/search', 'DriverController@search')
        ->name('driverSeach');
    Route::post('drivers/approve/{driver}', 'DriverController@approve');
    Route::post('drivers/decline/{driver}', 'DriverController@decline');
    Route::resource('drivers', 'DriverController');
});

Route::get('/home', 'HomeController@index');
