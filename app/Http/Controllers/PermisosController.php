<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Core\Procedimientos\SeguridadProcedure;
 

class PermisosController extends Controller
{
    protected $SeguridadProcedure;

    public function __construct(SeguridadProcedure $seguridadProcedure){
        $this->SeguridadProcedure = $seguridadProcedure;
    }

    public function index() {
        return view('modulos.seguridad.permisos');
    }

    public function fecha() {
         date_default_timezone_set('America/Lima');
        $year = date('Y');
        $mes = date('m');
        $dia = date('d');
        $hora= date('H');
        $minutos = date('i');
        $segundos = date('s');

       return $fecha_actualizacion =$year.'-'.$mes.'-'.$dia.' '.$hora .':'.$minutos.':'.$segundos.'';

    }

     public function store(Request $request)
    {
       $request->validate([
            'slug' => 'required|max:30|unique:permissions',
            'name' => 'required|unique:permissions|max:30',
            'description'=> 'required|max:100',

        ],['slug.required' => 'El slug es requerido','slug.max' => 'El slug solo puede tener un maximo de 30 caracteres','slug.unique' => "El nombre del slug debe ser unico",
            'name.required' => 'El nommbre es requerido','name.max' => 'El nombre solo puede tener un maximo de 30 caracteres','name.unique' => "El nombre  debe ser unico",
            'descripcion.required' => 'La descripción es requerida','slug.max' => 'La descripción solo puede tener un maximo de 100 caracteres',
        ]);
    
        try{
            $this->SeguridadProcedure->storePermisos($request->input('name'),$request->input('slug'),$request->input('description'),$this->fecha());
            return response()->json(['success'=>'Informacion guardada con exito']);
        }catch (QueryException $e){
            $array = array("Error" , $e);
            return $array;
        }
    }

    public function show($id) {
         try{
          return  $this->SeguridadProcedure->showPermisos($id);
        }catch (QueryException $e){
            $array = array("Error" , $e);
            return $array;
        }
    }

    public function update(Request $request) {
        $request->validate([
               'slug' => 'required|max:30',
               'name' => 'required|max:30',
               'description'=> 'required|max:100',

           ],['slug.required' => 'El slug es requerido','slug.max' => 'El slug solo puede tener un maximo de 30 caracteres','slug.unique' => "El nombre del slug debe ser unico",
               'name.required' => 'El nommbre es requerido','name.max' => 'El nombre solo puede tener un maximo de 30 caracteres','name.unique' => "El nombre  debe ser unico",
               'descripcion.required' => 'La descripción es requerida','slug.max' => 'La descripción solo puede tener un maximo de 100 caracteres',
           ]);
        
        $id   = (integer) $request->input('id'); 
        $name = $request->input('name');
        $slug = $request->input('slug');
        $description = $request->input('description');

        //dd($request);


            try{       
                $this->SeguridadProcedure->updatePermisos($id,$name,$slug,$description,$this->fecha());
                return response()->json(['success'=>'Informacion guardada con exito']);
            }catch (QueryException $e){
                $array = array("Error" , $e->errorInfo[1]);
                return $array;
            }
        
    }

     public function consularPermisosName($permiso='')
    {
       // return \DB::select('call spConsultarPermisosNombre(?)',array($permiso));
    }

     public function destroy($id)
    {
         //  $result = db::table('permissions')->where('id',$id)->delete();
         //  return $result;
    }

     public function loadData($pagination,$pagina = 0,$nombre = null) {
        if($nombre == null) {
            $datos =  $this->SeguridadProcedure->consultarPermisosTodos();
            return $this->paginacion($pagina,$datos,$pagination);
        } else {
            return $this->search($nombre,$pagina,$pagination);
        }

    }

    public function search($nombre,$pagina = 0,$pagination) {
        $datos = $this->SeguridadProcedure->consultarPermiso($nombre);
        return  $this->paginacion($pagina,$datos,$pagination);
    }

    public function paginacion($pagina,$datos,$pagination) {
        $paginacion = $pagination; // cuantos datos tenemos que recresar por pagina
        $pagina != 0 ? $pagina = ($pagina - 1) * $paginacion : $pagina  = 0; // se hace el calculo de los resultados quqe debe devolver
        $page = Input::get('page'); // solo es un nombre
        $total = count($datos);
        $datos = array_slice($datos, $pagina , $paginacion); // 1: datos , 2: desde que posicion  , 3: cuantos datos
        $datos = new LengthAwarePaginator($datos, $total, $paginacion, $page);
        $datos->setPath('blog'); // es una ruta X
        return $datos;
    }
}
