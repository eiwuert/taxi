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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function() {
	Route::get('login', 'AuthController@form')
        ->name('login');
    Route::post('login', 'AuthController@login');
	Route::get('dashboard', 'DashboardController@index')
        ->name('dashboard');
	Route::resource('drivers', 'DriverController@index');
});

Route::get('/home', 'HomeController@index');
