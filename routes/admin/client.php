<?php
/**
 * Routes for clients.
 */
Route::group(['prefix' => 'clients', 'middleware' => ['superadmin']], function () {
    Route::get('filter', 'ClientController@filter')
        ->name('clients.filter');
    Route::get('search', 'ClientController@search')
        ->name('clients.search');
    Route::post('lock/{client}', 'ClientController@lock')
        ->name('clients.lock');
    Route::post('unlock/{client}', 'ClientController@unlock')
        ->name('clients.unlock');
    Route::get('delete/picture/{client}', 'ClientController@deletePicture')
        ->name('clients.delete.picture');
});
Route::resource('clients', 'ClientController', ['middleware' => 'superadmin']);
