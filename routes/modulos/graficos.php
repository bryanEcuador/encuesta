<?php

route::middleware(['auth'])->group(function () {
    Route::group(['prefix' => 'administracion', 'as' => 'administracion.'], function () {
        route::get('graficos-encuesta', 'EncuestaController@index')->name('graficos-encuesta');
        route::get('excel/{tipo?}/{year?}', 'EncuestaController@excel');
        route::get('imprimir/{tipo?}/{year?}', 'EncuestaController@imprimir');
        route::get('prueba/{year?}', function () {
            $array = array(15,20,47);
            return $array;
        });
     });
});