<?php

namespace App\Http\Controllers;

use App\Exports\graficosExport;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use App\Notifications\EncuestaNotification;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Core\procedimientos\EncuestaProcedure;
use App\Mail\EncuestaMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
// modelos
use App\User;
use App\Core\Modelos\AreasDificultad;
use App\Core\Modelos\CalificacionDocente;
use App\Core\Modelos\CalificacionProfesion;
use App\Core\Modelos\ConocimientosAdquiridos;
use App\Core\Modelos\ContenidoaIncluir;
use App\Core\Modelos\DatosPersonales;
use App\Core\Modelos\Encuesta;
use App\Core\Modelos\InformacionProfesional;
use App\Core\Modelos\NivelCargoTrabajo;
use App\Core\Modelos\preferenciaEstudio;
use App\Core\Modelos\RecursosCarrera;
use App\Core\Modelos\RelacionCarrera;
use App\Core\Modelos\RelacionDesempeño;
use App\Core\Modelos\TemasInteres;
use App\Core\Modelos\TipoInstitucion;




class EncuestaController extends Controller
{
    use Notifiable;
    protected $EncuestaNotification;
    protected $EncuestaProcedure;
    protected $EncuestaMail;


    public function __construct(EncuestaNotification $encuestaNotification, EncuestaProcedure $encuestaProcedure ,EncuestaMail $encuestaMail)
    {
        $this->EncuestaNotification = $encuestaNotification;
        $this->EncuestaProcedure = $encuestaProcedure;
        $this->EncuestaMail = $encuestaMail;

        $areasDificultad = new AreasDificultad();
        $calificacionDocente = new CalificacionDocente();
        $calificacionProfesion = new CalificacionProfesion();
        $conocimientosAdquiridos = new ConocimientosAdquiridos();
        $contenidoaIncluir = new ContenidoaIncluir();
        $datosPersonales = new DatosPersonales();
        $encuesta = new Encuesta();
        $informacionProfesional = new InformacionProfesional();
        $nivelCargoTrabajo = new NivelCargoTrabajo();
        $preferenciasEstudio = new preferenciaEstudio();
        $recursosCarrera = new RecursosCarrera();
        $relacionDesempeño = new RelacionDesempeño();
        $temasInteres = new TemasInteres();
        $tipoInstitucion = new TipoInstitucion();
    }

   
    public function index() {    
    }

    // envia una notificación con el porcentaje de resultados
    public function notifify(){
        $encuestados = "200";
        $porcentaje = "75%";
        $user = auth()->user(); 
        $user->notify(new EncuestaNotification($encuestados,$porcentaje));

    }

   
   
    // consultas de la encuesta

     //Consultar nacionalidad
    public function getNacionalidadAll()
    {
        
        return $this->EncuestaProcedure->getNacionalidadAll();
    }
    //consultar genero
    public function getGeneroAll()
    {
        return $this->EncuestaProcedure->getGeneroAll();
    }

    // consultar carrera
    public function getCarreraAll()
    {
        return $this->EncuestaProcedure->getCarreraAll();
    }

    // estado civil
    public function getEstadoCivilAll()
    {
        return $this->EncuestaProcedure->getEstadoCivilAll();
    }

    // pais de residencia
    public function getPaisAll()
    {
        return $this->EncuestaProcedure->getPaisAll();
    }

    // etnia
    public function getEtniaAll()
    {
        return $this->EncuestaProcedure->getEtniaAll();
    }

    // tipo de institucion
    public function getInstitucionAll()
    {
        return $this->EncuestaProcedure->getInstitucionAll();
    }

    //cargo que ocupa
    public function getCargoAll()
    {
        return  $this->EncuestaProcedure->getCargoAll();
    }

    // rango de sueldo
    public function getRangoSueldoAll()
    {
       return  $this->EncuestaProcedure->getRangoSueldoAll();
    }

    //funcion para enviar correos para realizar la encuesta 

    public function emailSend() {

        //obtener los usuarios
       $user = user::find(4);
        Mail::to($user)->send( new EncuestaMail($user));
        
            // for con todos los usuarios
                //la clase para enviar los correos

    }

    public function store(EncuestaRequest $request){

        $error = null;
        DB::beginTransaction();
        try {

            //guardando los datos de personales
                $datosPersonales->nombre = $request->input("nombres") ;
                $datosPersonales->apellidos = $request->input("apellidos") ;
                $datosPersonales->fecha_nacimiento = $request->input("fecha_nacimiento") ;
                $datosPersonales->genero_id = $request->input("genero") ;
                $datosPersonales->fecha_graduacion = $request->input("fecha_graduacion") ;
                $datosPersonales->carrera_id = $request->input("carrera") ;
                $datosPersonales->discapacidad = $request->input("discapacidad") ;
                $datosPersonales->carnet_conadis = $request->input("carnet_conadis") ;
                $datosPersonales->estado_civil_id = $request->input("estado_civil") ;
                $datosPersonales->hijos = $request->input("numero_hijos") ;
                $datosPersonales->pais_id = $request->input("pais") ;
                $datosPersonales->ciudad_id = $request->input("ciudad") ;
                $datosPersonales->num_celular = $request->input("celular") ;
                $datosPersonales->num_convencional = $request->input("convencional") ;
                $datosPersonales->direccion = $request->input("dirección") ;
                $datosPersonales->correo_personal = $request->input("correo") ;
                $datosPersonales->etnia_id = $request->input("etnia") ;
                $datosPersonales->identificacion_id = $request->input("tipo_identificacion") ;
                $datosPersonales->numero_identificacion = $request->input("identificacion") ;
                $datosPersonales->usuario_creacion = $request->input("") ;
                $datosPersonales->usuario_modificacion = $request->input("") ;

                $datosPersonales->save() ;

            // informacion profesional
                $informacionProfesional->trabajo_actual = $request->input("trabajo_actual");
                $informacionProfesional->tipo_institucion_id = $request->input("tipo_institucion");
                $informacionProfesional->nombre_empresa = $request->input("empresa");
                $informacionProfesional->actividad_empresa_id = $request->input("actividad_empresa");
                $informacionProfesional->cargo_id = $request->input("cargo");
                $informacionProfesional->tiempo_trabajo = $request->input("tiempo_laborando");
                $informacionProfesional->tipo_contrato_id = $request->input("tipo_contrato");
                $informacionProfesional->rango_sueldo = $request->input("rango_sueldo");
                $informacionProfesional->trabajo_exterior = $request->input("trabajo_exterior");
                $informacionProfesional->relacion_profesional_id = $request->input("relacion_carrera_profesional");
                $informacionProfesional->nivel_estudio = $request->input("nivel_estudio_acorde");
                $informacionProfesional->dificil_empleo = $request->input("dificultad_para_trabajar");
                $informacionProfesional->usuario_creacion = $request->input("");
                $informacionProfesional->usuario_modificacion = $request->input("");





                

            //$datosPersonales->id;
            // hace un commit si todo sale bien
            DB::commit();
            $success = true;
        } catch (\Exception $e) {

            // hace un rollback si todo falla y envia un mensaje de error
            $success = false;
            $error = $e->getMessage();
            DB::rollback();
        }

    }
    
}
