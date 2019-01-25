<?php
use App\User;
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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/notificaciones','EncuestaController@notifify');
Route::get('/leer-notificaciones', 'EncuestaController@read');
Route::get('/prueba', function () {

    $user = \DB::table('tb_correos')->whereYear('fecha_creacion',2019)->get();
    dd($user);
     
/*        $users = User::all();
      $users = $users->whereIn('id',4);
      dd($users);
      foreach ($users as  $user) {
       echo $user->id;
          DB::table('tb_correos')->insert([
            'user_id' => $user->id  , 'estado' => 0 , 'fecha_id' => 1 , 'token' =>  str_random(16),
         ]); 
      }
    Flight::where('foo', 'bar')->cursor()   */
  
});


