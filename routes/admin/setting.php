<?php
/**
 * Settings related routes.
 */
Route::get('settings/general', 'SettingController@general')
        ->name('settings.general');
Route::get('settings/backup', 'Setting\BackupController@index')
        ->name('settings.backup.index');
Route::get('settings/backup/download/{file}', 'Setting\BackupController@download')
        ->name('settings.backup.download');
Route::get('settings/backup/delete/{file}', 'Setting\BackupController@delete')
        ->name('settings.backup.delete');
Route::get('settings/backup/new', 'Setting\BackupController@new')
        ->name('settings.backup.new');
