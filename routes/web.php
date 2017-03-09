<?php
require base_path('routes/admin/auth.php');

Route::get('/', 'HomeController@index');
Route::post('payment/charge', 'PaymentController@charge');
Route::get('payment/charge/{id}/{amount}', 'PaymentController@redirectCharge');

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
