<?php
Route::group(['prefix' => 'administracion', 'as' => 'administracion.'], function () {

    Route::middleware(['auth'])->group(function () {

        route::get('logs','LogController@index')->name('logs.usuarios');
        route::get('obtener-usuarios', 'LogController@getUser')->name('obtener.usuarios');
        route::get('logs/usuarios/{user}/{desde?}/{hasta?}', 'LogController@userLogs')->name('logs.user');
        route::get('logs/tablas/{user}/{tabla?}/{desde?}/{hasta?}', 'LogController@tableLogs')->name('logs.table');

        route::get('user/logs/all/{id}/{fecha}', 'LogController@userLog'); // obtener

        route::get('table/log/{tabla}/{user}/{desde?}/{hasta?}','LogController@showTableLogs');

        route::get('logs/all','LogController@getLogAllTable');

        Route::get('logs/sistema', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name('logs.sistema');
       
    });
});
