<?php
        
namespace App\Core\Procedimientos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SeguridadProcedure extends Model
{
    public function permisos (){
       return DB::table('permissions')->get();   
    }

    public function storePermisos($name,$slug,$description,$fecha) {
        return DB::table('permissions')->insertGetId(
                [   'name' => $name,
                    'slug' => $slug,
                    'description' => $description,
                    'created_at' => $fecha,
                    'updated_at' => $fecha                ]
            );
    }

     public function updatePermisos($id,$name,$slug,$description,$fecha) {
       
        return  DB::table('permissions')->where('id',$id)
                    ->update([ 'name' => $name,
                        'slug' => $slug,
                        'description' => $description,
                        'updated_at' =>$fecha
                    ]);
    }


     public function showPermisos($id) {
        return DB::table('permissions')->where('id',$id)->get();
    }

    public function consultarPermiso($nombre = '') {
          return DB::select('call spConsultarPermisosNombre(?)',array($nombre));
    }

    public function consultarPermisosTodos() {
       return DB::select('call spConsultarPermisostodos');
    }

     public function consultarUsuariosTodos() {
       return  DB::table('users')
            ->join('role_user','users.id','=','role_user.user_id')
            ->join('roles','role_user.role_id','=','roles.id')
            ->select('users.id','users.name','roles.name as rol')
            ->where('users.state',1)
            ->get()->toArray();
    }

    public function consultarUsuario($nombre,$rol) {

        if($nombre == null && $rol !== 0) {
            return  DB::table('users')
                ->join('role_user','users.id','=','role_user.user_id')
                ->join('roles','role_user.role_id','=','roles.id')
                ->select('users.id','users.name','roles.name as rol')
                ->where([
                    ['users.estado',1] , ['roles.id',$rol]
                ])
                ->get()->toArray();
        }else if ($nombre !== null && $rol == 0) {
            return  DB::table('users')
                ->join('role_user','users.id','=','role_user.user_id')
                ->join('roles','role_user.role_id','=','roles.id')
                ->select('users.id','users.name','roles.name as rol')
                ->where([
                    ['users.estado',1] , ['users.name', 'like', $nombre]
                ])
                ->get()->toArray();
        } else if ($nombre !== null && $rol !== 0){
            return  DB::table('users')
                ->join('role_user','users.id','=','role_user.user_id')
                ->join('roles','role_user.role_id','=','roles.id')
                ->select('users.id','users.name','roles.name as rol')
                ->where([
                    ['users.estado',1] , ['users.name', 'like', $nombre] , ['roles.id',$rol]
                ])
                ->get()->toArray();
        }

    }

    public function validarUsuario($dato,$tipo,$metodo,$id) {
        
        if($metodo == 'store' ) {
            if($tipo == 'email') {
                return  DB::table('users')->select('id')->where('email',$dato)->get();
            }else if($tipo == 'nombre'){
                return  DB::table('users')->select('id')->where('name',$dato)->get();
            }
        }else if($metodo == 'update') {
             if($tipo == 'email') {
                return  DB::table('users')->select('id')->where([ ['email',$dato], ['id','<>',$id]])->get();
            }else if($tipo == 'nombre'){
                return    DB::table('users')->select('id')
                ->where([ 
                        ['name',$dato], ['id','<>',$id]
                    ])->get();
            }
        }
    }

    public function usuariosShow($id){
        return DB::select('call spUsuariosShow(?)',array($id));
    }

    public function usuarioUpdate($name,$rol,$password,$email,$fecha_modficacion,$id) {
         if($password===null || $password === ''){
                $user = DB::table('users')->where('id',$id)
                    ->update([
                        'name'  => $name,
                        'email' => $email,
                        'updated_at' => $fecha_modficacion
                    ]);

                DB::table('role_user')->where('user_id',$id)
                    ->update(['role_id' => $rol]);

            }else{
                $user = DB::table('users')->where('id',$id)
                    ->update([
                        'name'  => $name,
                        'email' => $email,
                        'password' => bcrypt($password),
                        'updated_at' => $fecha_modficacion,
                    
                    ]);

                DB::table('role_user')->where('user_id',$id)
                    ->update(['role_id' => $rol]);

            }
    }

    public function usuariosDelete($id){
      return   DB::table('users')->where('id',$id)
            ->update(['estado' => 0
            ]);
    }
     
}
