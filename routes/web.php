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
Route::get('test', function() {
/*$exclude = \App\Trip::whereNotIn('status_id', [15, 16, 17])
                    ->where('client_id', 102)
                    ->where('created_at', '>', \Carbon\Carbon::today()->subMinutes(2)->toDateTimeString())
                    ->get(['driver_id'])->flatten();
$toExclude = [];
foreach ($exclude as $e) {
    if (! is_null($e->driver_id))
        $toExclude[] = $e->driver_id;
}
$toExclude = array_unique($toExclude);
dd($toExclude);*/
\App\Repositories\LocationRepository::set(0.0, 0.0, 1);
});
require base_path('routes/admin/auth.php');
Route::get('/', 'HomeController@index');

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 
            'middleware' => ['auth', 'can:access', 'verified']], function() {
	Route::get('dashboard', 'DashboardController@index')
        ->name('dashboard');
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
});

Route::get('/home', 'HomeController@index');
