<?php

use Illuminate\Http\Request;

/**
 * Client Routes.
 */

Route::group(['prefix' => 'client', 'middleware' => 'header'], function() {
});

/**
 * Driver Routes.
 */
Route::group(['prefix' => 'driver', 'middleware' => 'header'], function() {
});

Route::any('{any}', function() {
    return fail([
            'title'  => 'Not found',
            'detail' => 'Requested route not found',
        ], 404);
})->where('any', '.*');
