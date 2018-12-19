<?php

route::middleware(['auth'])->group(function () {

    route::get('graficos-encuesta', 'EncuestaController@index')->name('graficos-encuesta');

});