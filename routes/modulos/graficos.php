<?php

route::middleware(['auth'])->group(function () {
    Route::group(['prefix' => 'administracion', 'as' => 'administracion.'], function () {
        route::get('graficos-encuesta', 'EncuestaController@index')->name('graficos-encuesta');
        route::get('excel/{tipo?}', 'EncuestaController@excel');
        route::get('pdf/{tipo?}','EncuestaController@pdf');
        route::get('prueba/{year?}', function () {
            $array = array(15,20,47);
            return $array;
        });
     });
});