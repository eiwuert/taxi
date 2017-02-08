<?php
/**
 * Settings related routes.
 */
Route::group(['prefix' => 'settings'], function() {
    Route::get('general', 'SettingController@general')
            ->name('settings.general');
    Route::group(['prefix' => 'backup', 'namespace' => 'Setting'], function() {
        Route::get('/', 'BackupController@index')
                ->name('settings.backup.index');
        Route::get('download/{file}', 'BackupController@download')
                ->name('settings.backup.download');
        Route::get('delete/{file}', 'BackupController@delete')
                ->name('settings.backup.delete');
        Route::get('new', 'BackupController@new')
                ->name('settings.backup.new');
    });
    Route::get('logs', 'Setting\LogController@index')
         ->name('settings.logs.index');
    Route::get('requests', 'Setting\RequestController@index')
         ->name('settings.requests.index');
    Route::get('fcm', 'Setting\FcmController@index')
         ->name('settings.fcm.index');
});
