<?php
/**
 * Profile specific profile routes
 */
Route::group(['prefix' => 'profile'], function () {
    Route::get('edit', 'WebController@edit')
        ->name('webs.edit');
    Route::post('update', 'WebController@update')
        ->name('webs.update');
});
