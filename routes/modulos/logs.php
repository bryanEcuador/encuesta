<?php
Route::group(['prefix' => 'administracion', 'as' => 'administracion.'], function () {

    Route::middleware(['auth'])->group(function () {

        route::get('logs','LogController@index')->name('log');
        route::get('obtener-usuarios', 'LogController@getUser')->name('obtener.usuarios');
        route::get('logs/usuarios/{user}/{desde?}/{hasta?}', 'LogController@userLogs')->name('logs.user');
        route::get('logs/tablas/{user}/{tabla?}/{desde?}/{hasta?}', 'LogController@tableLogs')->name('logs.table');
        route::get('user/logs/all/{id}', 'LogController@getLogAllUser')->name('logs.all');
        route::get('prueba', 'LogController@storeLogUser');
    });
});
