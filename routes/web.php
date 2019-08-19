<?php
use App\User;
use App\Core\Modelos\Correos;
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
require_once __DIR__. '/modulos/logs.php';
require_once __DIR__. '/modulos/encuesta.php';
/* require __DIR__ . '/modulos/proveedores.php';
 */
Auth::routes();
Route::redirect('/register', '/home', 301);
Route::redirect('/', '/login', 301);
Route::get('/home/{estado?}', 'HomeController@index')->name('home');
Route::get('/notificaciones','EncuestaController@notifify');
Route::get('/leer-notificaciones', 'EncuestaController@read');






