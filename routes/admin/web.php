<?php
/**
 * Profile specific profile routes
 */
Route::resource('users', 'WebController');
Route::patch('user/{user}/update/email', 'WebController@updateEmail');
Route::patch('user/{user}/update/password', 'WebController@updatePassword');
