<?php
require base_path('routes/admin/auth.php');

Route::get('/', 'HomeController@fa')->name('faHome');
Route::get('/terms', 'HomeController@faTerms')->name('faTerms');
Route::get('/global', 'HomeController@en')->name('enHome');
Route::get('/global/terms', 'HomeController@enTerms')->name('enTerms');

// Route::get('/', 'HomeController@index');
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
    // PAYMENTS
    require base_path('routes/admin/payment.php');
    // PROFILE
    require base_path('routes/admin/web.php');
    // Export
    Route::get('export/{name}', 'ExportController@export')->name('admin.export');
    // Change Language
    Route::get('switch', 'DashboardController@switchLang')->name('switch');
    // Agencies Info
    Route::resource('agencies', 'AgencyController', ['middleware' => ['superadmin']]);
    // Car types
    Route::resource('types', 'TypeController', ['middleware' => ['superadmin']]);
    // Zones
    Route::resource('zones', 'ZoneController', ['middleware' => ['superadmin']]);
    // Fares
    Route::resource('fares', 'FareController', ['middleware' => ['superadmin']]);
});
