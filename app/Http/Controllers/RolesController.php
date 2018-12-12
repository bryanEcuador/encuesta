<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Database\QueryException;

class RolesController extends Controller
{
     public function index()
    {
        //
        $resultado = DB::table('roles')
            ->select('id','name','slug','description','special')->get();
            //->paginate(2);
        return view('modulos.seguridad.roles.index',compact('resultado'));
    }

    public function create()
    {
        return view('modulos.seguridad.roles.create');
    }

    public function getFechaActual(){
        date_default_timezone_set('America/Lima');
        $year = date('Y');
        $mes = date('m');
        $dia = date('d');
        $hora= date('H');
        $minutos = date('i');
        $segundos = date('s');

        $fecha_actualizacion =$year.'-'.$mes.'-'.$dia.' '.$hora .':'.$minutos.':'.$segundos.'';
        return $fecha_actualizacion;
    }


    public function store(Request $request)
    {
        //dd($request->input());
        $request->validate([
            'slug' => 'required|max:30|unique:roles|string',
            'name' => 'required|max:30|unique:roles|string',
            'description'=> 'required|max:100|string',

        ],['slug.required' => 'El slug es requerido','slug.max' => 'El slug solo puede tener un maximo de 30 caracteres','slug.unique' => "El nombre del slug debe ser unico",
            'name.required' => 'El nommbre es requerido','name.max' => 'El nombre solo puede tener un maximo de 30 caracteres','name.unique' => "El nombre  debe ser unico",
            'descripcion.required' => 'La descripción es requerida','slug.max' => 'La descripción solo puede tener un maximo de 100 caracteres',
        ]);


                $name = $request->input('name');
                $slug = $request->input('slug');
                $description = $request->input('description');
                $permisos = $request->input('permisos');

                if($request->input('special') == 'neutro' )
                {
                    $special = null;
                } else {
                    $special = $request->input('special');
                }

                $fecha = $this->getFechaActual();

                try{

                    $id =DB::table('roles')->insertGetId(
                        [   'name' => $name,
                            'slug' => $slug,
                            'description' => $description,
                            'special' => $special,
                            'created_at' => $fecha ,
                            'updated_at' => $fecha
                        ]
                    );
                    if($permisos != null || $permisos != ''){
                        foreach ($permisos as $items) {
                            DB::table('permission_role')->insert([
                                'permission_id' => $items,
                                'role_id' => $id,
                                'created_at' => $fecha ,
                                'updated_at' => $fecha
                            ]);
                        }
                    }
                    flash()->success('se ha registrado el rol con exito');
                    return redirect()->route('seguridad.roles.create');
                }catch (QueryException $e){
                    flash()->error("Error".$e->errorInfo[1]);
                    return redirect()->route('seguridad.roles.create');

                }


    }
    public function show($id)
    {
        $id = decrypt($id);
        $resultado = DB::table('roles')->where('id',$id)->get();
        $permisos = \DB::select('Call spPermisosRol(?)',array($id));
        return view('modulos.seguridad.roles.show',compact('resultado','permisos'));
    }

    public function edit($id)
    {
        $id = decrypt($id);
        $resultado = DB::table('roles')->where('id',$id)->get();
        $permisos = \DB::select('Call spPermisosRol(?)',array($id));
        $permisosF = \DB::select('Call spPermisosRolFaltantes(?)',array($id));
        return view('modulos.seguridad.roles.edit',compact('resultado','permisos','permisosF'));
    }

    public function update(Request $request, $id)
    {
        //dd($request->all());
        /* validaciones del lado del controlador  */
        $request->validate([
            'slug' => 'required|max:30|string',
            'name' => 'required|max:30|string',
            'description'=> 'required|max:100|string',

        ],['slug.required' => 'El slug es requerido','slug.max' => 'El slug solo puede tener un maximo de 30 caracteres','slug.unique' => "El nombre del slug debe ser unico",
            'name.required' => 'El nommbre es requerido','name.max' => 'El nombre solo puede tener un maximo de 30 caracteres','name.unique' => "El nombre  debe ser unico",
            'descripcion.required' => 'La descripción es requerida','slug.max' => 'La descripción solo puede tener un maximo de 100 caracteres',
        ]);

        /* obtenemos los valores del formulario */ 
        $permisos_anteriores = DB::table('permission_role')->select('id')->where('role_id',$id)->get(); //los que tenia
        $actuales = $request->input('actuales'); // los que pasamos
        $eliminar = []; // aqui vamos a agregar los permisos que se deben eliminar

        $name = $request->input('name');
        $slug = $request->input('slug');
        $description = $request->input('description');
        $permisos = $request->input('permisos'); /* TODO */

        if($request->input('especial') === "null"){
            $special = null;
        } else {
           $special = $request->input('especial');
        }
        $nuevos =  $request->input('nuevos'); // aqui estan los nuevos permisos que agregamos

        
        /* validamos que el nombre y el slug del rol no se encuentre en la base de datos  */
        $result = DB::table('roles')->select('id')->where([['name',$name],['slug',$slug],['id', '!=' ,$id]])->get();
        if($result->first() == null){
            try{

                // agregamos a un array  los permisos que han sido desmarcados de la lista de actuales
                if($request->input('actuales') == null)
                {
                    /* si no hay ningun permiso en el array todos estaran desmarcados así que borralos todos */
                    DB::table('permission_role')->where('role_id', '=', $id)->delete();
                } else {
                    /* recorremos el array de los permisos que se tenía */
                    foreach ($permisos_anteriores as $a) {
                        /* obtenemos los permisos actuales pasados desde la vista */
                        $clave = array_search($a->id, $actuales);
                        if($clave === false && $clave !==0) {
                            array_push($eliminar,$a->id);
                        }
                    }
                }


                // comenzamos con la eliminación
                if($eliminar != [])
                {
                    foreach ($eliminar as $item){
                        \DB::table('permission_role')->where('id', '=', $item)->delete();
                    }
                }

                $fecha = $this->getFechaActual();

                DB::table('roles')->where('id',$id)
                    ->update([ 'name' => $name,
                        'slug' => $slug,
                        'description' => $description,
                        'special' => $special,
                        'updated_at' => $fecha
                    ]);

                // agregamos los permisos nuevos
                if($nuevos != null || $nuevos != ''){
                    foreach ($nuevos as $items) {
                        DB::table('permission_role')->insert([
                            'permission_id' => $items,
                            'role_id' => $id,
                        ]);
                    }
                }
                flash()->success('se ha actualizado el rol con exito');
                return redirect()->route('seguridad.roles.index');
            }catch (QueryException $e){
                //echo "error";
                flash()->error("Error".$e->errorInfo[1]);
               return redirect()->route('seguridad.roles.create');
            }

        }else{
            flash()->error('El nombre y el slug deben de ser unicos');
            return redirect()->route('seguridad.roles.edit',['edit'=>$id]);
        }

    }


    public function destroy($id)
    {
        //
    }

    public function table()
    {
        $result = DB::table('roles')
            ->select('id','name','slug','description','special')
            ->get();

        return $result;
    }

    public function rolesPermisos($id) {

        $result = DB::table('permission_role')
            ->join('permissions','permissions.id','=','permission_role.permission_id')
            ->select('permissions.name')
            ->where('role_id',$id)
            ->get();
        return $result;
    }

    public function uniqueName($name) {
        $resultado = DB::table('roles')->select('id')->where('name',$name)->get();
        $resultado = (object) $resultado;
        if(isset($resultado[0]->id))
        {
            return 0;
        }else {
            return 1;
        }

    }

    public function uniqueSlug($name) {
        $resultado = DB::table('roles')->select('id')->where('slug',$name)->get();
        $resultado = (object) $resultado;
        if(isset($resultado[0]->id))
        {
            return 0;
        }else {
            return 1;
        }
    }
    public function uniqueNameUpdate($name,$id) {
        $resultado = DB::table('roles')->select('id')->where([['name',$name],['id','<>',$id]])->get();
        $resultado = (object) $resultado;
        if(isset($resultado[0]->id))
        {
            return 0;
        }else {
            return 1;
        }
    }

    public function uniqueSlugUpdate($name,$id) {
        $resultado = DB::table('roles')->select('id')->where([['slug',$name],['id','<>',$id]])->get();
        $resultado = (object) $resultado;
        if(isset($resultado[0]->id))
        {
            return 0;
        }else {
            return 1;
        }
    }

     public function permisos()
    {
       return DB::table('permissions')
        ->select('id','name','slug','description')
        ->get();
        
    }
}
