<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require_once __DIR__. '/modulos/seguridad.php';
require_once __DIR__. '/modulos/graficos.php';
/* require __DIR__ . '/modulos/proveedores.php';
 */
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/notificaciones','EncuestaController@notifify');
Route::get('/leer-notificaciones', 'EncuestaController@read');
