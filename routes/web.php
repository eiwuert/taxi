<?php
require base_path('routes/admin/auth.php');

Route::get('/', 'HomeController@fa')->name('faHome');
Route::get('/terms', 'HomeController@faTerms')->name('faTerms');
Route::get('/global', 'HomeController@en')->name('enHome');
Route::get('/global/terms', 'HomeController@enTerms')->name('enTerms');
Route::post('contacts', 'ContactController@store')->name('contact.store');

Route::post('payment/charge', 'PaymentController@charge');
Route::get('payment/charge/{id}/{amount}', 'PaymentController@redirectCharge');

Route::get('test', function () {
    \Auth::loginUsingId(24);
    return event(new \App\Events\StateChanged(\Auth::user()));
});

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
    // Fare Calculator
    Route::get('fares/calculator', 'FareController@calculator')
        ->middleware('superadmin')
        ->name('fares.calculator');
    // Fares
    Route::resource('fares', 'FareController', ['middleware' => ['superadmin']]);
    // Currencies
    Route::resource('currencies', 'CurrencyController', ['middleware' => ['superadmin']]);
    // Contacts
    Route::get('contacts', 'ContactController@index')->name('contacts.index');
    Route::get('contacts/{contact}', 'ContactController@show')->name('contacts.show');
    Route::delete('contacts', 'ContactController@destroy')->name('contacts.destroy');
});
