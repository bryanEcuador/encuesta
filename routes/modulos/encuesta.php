<?php
use App\Core\Modelos\Correos;

// selecet 
route::get('get-nacionalidad', 'EncuestaController@getNacionalidadAll');
route::get('get-genero', 'EncuestaController@getGeneroAll');
route::get('get-estado-civil', 'EncuestaController@getGeneroAll');
route::get('get-carrera', 'EncuestaController@getCarreraAll');
route::get('get-pais', 'EncuestaController@getPaisAll');
route::get('get-etnia', 'EncuestaController@getEtniaAll');
route::get('get-institucion', 'EncuestaController@getInstitucionAll');
route::get('get-cargo', 'EncuestaController@getCargoAll');
route::get('get-rango', 'EncuestaController@getRangoSueldoAll');
//
route::post('enviar-encuesta', 'CorreosController@enviarEncuesta')->name('enviar.correos');


route::get('porcentaje/encuesta/{year}', 'EncuestaController@porcentajeEncuestados');

route::get('encuesta/{token?}/{promocion?}', 'EncuestaController@validarEncuesta');

route::post('encuesta/store','EncuestaController@store');

route::get('error-encuesta', function(){
   return view('modulos.encuesta.errorEncuesta');
});
route::get('cancelar-encuesta/{id}','EncuestaController@cancelarEncuesta');

route::get('administracion-encuesta','PromocionesController@promocionesEnviadas')->name('encuesta.promocionesenviadas');
route::get('promociones','PromocionesController@promociones');

