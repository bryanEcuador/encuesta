<?php

route::middleware(['auth','permission:graficos'])->group(function () {

    Route::group(['prefix' => 'administracion', 'as' => 'administracion.'], function () {

        route::get('graficos-encuesta', 'GraficosController@index')->name('graficos-encuesta'); // vista principal
       
        route::get('excel/{tipo?}/{year?}', 'GraficosController@excel'); // descarga de excel
        route::get('imprimir/{tipo?}/{year?}', 'GraficosController@imprimir'); // imprimir pantalla
        route::get('grafico/{tipo?}/{year}', 'GraficosController@dibujarGrafico'); // forma los graficos
        route::get('prueba/{year?}', function () {
            $array = array(15,20,47);
            return $array;
        });

     });

});