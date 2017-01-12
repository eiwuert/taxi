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

Route::get('trip', function() {
            $exclude = \App\Trip::orWhere('status_id', '<>', \App\Status::where('name', 'trip_is_over')->firstOrFail()->value)
                            ->orWhere('status_id', '<>', \App\Status::where('name', 'client_rated')->firstOrFail()->value)
                            ->orWhere('status_id', '<>', \App\Status::where('name', 'driver_rated')->firstOrFail()->value)
                            ->orWhere('client_id', 101)
                            ->orWhere('created_at', '<', \Carbon\Carbon::now()->subMinutes(20)->toDateTimeString())
                            ->get(['driver_id'])->flatten();
    $toExclude = [];
    foreach ($exclude as $e) {
        if (! is_null($e->driver_id))
            $toExclude[] = $e->driver_id;
    }
    return implode(',', $toExclude);
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
    Route::post('drivers/offline/{driver}', 'DriverController@offline');
    Route::post('drivers/approve/{driver}', 'DriverController@approve');
    Route::post('drivers/decline/{driver}', 'DriverController@decline');
    Route::resource('drivers', 'DriverController');

    // CAR
    Route::resource('cars', 'CarController');
});

Route::get('/home', 'HomeController@index');
