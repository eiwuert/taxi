<?php
/**
 * Settings related routes.
 */
Route::group(['prefix' => 'settings', 'middleware' => 'superadmin'], function () {
    Route::get('general', 'Setting\GeneralController@index')
            ->name('settings.general.index');
    Route::patch('general', 'Setting\GeneralController@update')
            ->name('settings.general.update');
    Route::group(['prefix' => 'backup', 'namespace' => 'Setting'], function () {
        Route::get('/', 'BackupController@index')
                ->name('settings.backup.index');
        Route::get('download/{file}', 'BackupController@download')
                ->name('settings.backup.download');
        Route::get('delete/{file}', 'BackupController@delete')
                ->name('settings.backup.delete');
        Route::get('new', 'BackupController@newBackup')
                ->name('settings.backup.new');
    });
    Route::get('logs', 'Setting\LogController@index')
         ->name('settings.logs.index');
    Route::get('requests', 'Setting\RequestController@index')
         ->name('settings.requests.index');

//    FCM & Filtering
    Route::get('fcm', 'Setting\FcmController@index')
         ->name('settings.fcm.index');
    Route::get('fcm/filter', 'Setting\FcmController@filter')
        ->name('settings.fcm.filter');
    Route::get('fcm/search', 'Setting\FcmController@search')
        ->name('settings.fcm.search');

     Route::get('sms', 'Setting\SmsController@index')
          ->name('settings.sms.index');
});
