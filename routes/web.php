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
require base_path('routes/admin/auth.php');
Route::get('/', 'HomeController@index');
Route::post('payment/trip', 'PaymentController@trip');
Route::post('payment/charge', 'PaymentController@charge');

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'can:access', 'verified', 'csrf']], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    // DRIVERS
    require base_path('routes/admin/driver.php');
    // CLIENTS
    require base_path('routes/admin/client.php');
    // TRIPS
    require base_path('routes/admin/trip.php');
    // CARS
    Route::resource('cars', 'CarController');
    // MAPS
    require base_path('routes/admin/map.php');
    // SETTINGS
    require base_path('routes/admin/setting.php');
    // PROFILE
    require base_path('routes/admin/web.php');
});
