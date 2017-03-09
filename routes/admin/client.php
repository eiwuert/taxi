<?php
/**
 * Routes for clients.
 */
Route::group(['prefix' => 'clients'], function () {
    Route::get('filter', 'ClientController@filter')
        ->name('clients.filter');
    Route::get('search', 'ClientController@search')
        ->name('clients.search');
    Route::post('lock/{client}', 'ClientController@lock')
        ->name('clients.lock');
    Route::post('unlock/{client}', 'ClientController@unlock')
        ->name('clients.unlock');
});
Route::resource('clients', 'ClientController');
