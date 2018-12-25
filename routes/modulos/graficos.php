<?php

route::middleware(['auth'])->group(function () {
    Route::group(['prefix' => 'administracion', 'as' => 'administracion.'], function () {
        route::get('graficos-encuesta', 'EncuestaController@index')->name('graficos-encuesta');
     });
});