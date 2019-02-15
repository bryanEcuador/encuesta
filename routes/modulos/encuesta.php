<?php

/* route::get('encuesta', function(){
    return view('modulos.encuesta.encuesta');
}); */
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
route::get('enviar-encuesta', 'EncuestaController@emailSend');
route::get('encuesta', 'EncuestaController@ValidarEncuesta');
route::get('porcentaje/encuesta/{year}', 'EncuestaController@porcentajeEncuestados');
/* route::get('encuesta-prueba/{token}', 'EncuestaController@ValidarEncuesta'); */
// TODO: 