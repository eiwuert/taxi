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
Route::get('jsonify', function() {
    dd(\App\Repositories\LocationRepository::driversOnMap('online'));
});
Route::get('/', 'HomeController@index');
require base_path('routes/admin/auth.php');

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
    require base_path('routes/admin/maps.php');
});

Route::get('/home', 'HomeController@index');
