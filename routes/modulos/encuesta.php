<?php
use App\Core\Modelos\Correos;

// selecet 
route::get('get-nacionalidad', 'EncuestaController@getNacionalidadAll');
route::get('get-genero', 'EncuestaController@getGeneroAll');
route::get('get-estado-civil', 'EncuestaController@getEstadoCivilAll');
route::get('get-carrera', 'EncuestaController@getCarreraAll');
route::get('get-pais', 'EncuestaController@getPaisAll');
route::get('get-etnia', 'EncuestaController@getEtniaAll');
route::get('get-institucion', 'EncuestaController@getInstitucionAll');
route::get('get-cargo', 'EncuestaController@getCargoAll');
route::get('get-rango', 'EncuestaController@getRangoSueldoAll');
route::get('get-ciudad', function() {
   return DB::table('tb_ciudad')->select('id', 'descpcion')->get();
});
route::get('get-contrato', function () {
   return DB::table('tb_contrato')->select('id', 'tipo')->get();
});
//
route::post('enviar-encuesta', 'CorreosController@enviarEncuesta')->name('enviar.correos');


route::get('porcentaje/encuesta/{year}', 'EncuestaController@porcentajeEncuestados');

route::get('encuesta/{token?}/{promocion?}', 'EncuestaController@validarEncuesta');

route::post('encuesta/store','EncuestaController@store');

route::get('error-encuesta', function(){
   return view('modulos.encuesta.errorEncuesta');
});
route::get('cancelar-encuesta/{id}','EncuestaController@cancelarEncuesta')->middleware('permission:encuestas');

route::get('administracion-encuesta','PromocionesController@promocionesEnviadas')->name('encuesta.promocionesenviadas')->middleware('permission:encuestas');
route::get('promociones','PromocionesController@promociones');

