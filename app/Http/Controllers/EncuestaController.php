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
use App\Core\Modelos\preferenciaEstudio;
use App\Core\Modelos\RecursosCarrera;
use App\Core\Modelos\NivelCargoTrabajo;
use App\Core\Modelos\RelacionCarrera;
use App\Core\Modelos\RelacionDesempeño;
use App\Core\Modelos\TemasInteres;
use App\Core\Modelos\TipoInstitucion;
use App\Core\Modelos\Asignatura;
use App\Core\Modelos\Correos;
use App\Core\Modelos\EncuestasEnviadas;
// jobs
use App\Jobs\ProcessUsersMail;
use App\Jobs\ProcessMailEncuesta;
use PhpParser\Node\Expr\Array_;
use PhpParser\Node\Stmt\Foreach_;


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

        $datosPersonales = new DatosPersonales();
        $informacionProfesional = new InformacionProfesional();
        $calificacionProfesion = new CalificacionProfesion();
        $calificacionDocente = new CalificacionDocente();
        $conocimientosAdquiridos = new ConocimientosAdquiridos();
        $recursosCarrera = new RecursosCarrera();
        $areasDificultad = new AreasDificultad();
        $relacionDesempeño = new RelacionDesempeño();
        $preferenciasEstudio = new preferenciaEstudio();
        $temasInteres = new TemasInteres();
        $contenidoaIncluir = new ContenidoaIncluir();
        $asignatura = new Asignatura();
        
        $encuesta = new Encuesta();
        $nivelCargoTrabajo = new NivelCargoTrabajo(); //TODO
        //$tipoInstitucion = new TipoInstitucion();
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

    public function user_id($token){
       $correos = Correos::where('token',$token)->get()->toArray();
       return $correos[0]['user_id'];

    }

    //funcion para enviar correos para realizar la encuesta 



    public function store(Request $request){


        $datosPersonales = new DatosPersonales();
        $informacionProfesional = new InformacionProfesional();
        $calificacionProfesion = new CalificacionProfesion();
        $calificacionDocente = new CalificacionDocente();
        $conocimientosAdquiridos = new ConocimientosAdquiridos();
        $recursosCarrera = new RecursosCarrera();
        $areasDificultad = new AreasDificultad();
        $relacionDesempeño = new RelacionDesempeño();
        $preferenciasEstudio = new preferenciaEstudio();
        $temasInteres = new TemasInteres();
        $contenidoaIncluir = new ContenidoaIncluir();
        $asignatura = new Asignatura();
        $encuesta = new Encuesta();

        $user_id = $this->user_id($request->input('token'));
        $error = null;


        DB::beginTransaction();
        try {

            //guardando los datos de personales
                $datosPersonales->numero_identificacion = $request->input("identificacion") ;
                $datosPersonales->nombre = $request->input("nombres") ;
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
                $datosPersonales->nacionalidad = $request->input("nacionalidad");
                $datosPersonales->num_celular = $request->input("celular") ;
                $datosPersonales->num_convencional = $request->input("convencional") ;
                $datosPersonales->direccion = $request->input("direccion") ;
                $datosPersonales->correo_personal = $request->input("correo") ;
                $datosPersonales->etnia_id = $request->input("etnia") ;
                $datosPersonales->identificacion_id = 1; //$request->input("tipo_identificacion") ;
                $datosPersonales->usuario_creacion = $user_id;
                $datosPersonales->usuario_modificacion = $user_id;
                $datosPersonales->save() ;
                $datos_personales = $datosPersonales->id;

            // informacion profesional
                $informacionProfesional->trabaja_actualmente = $request->input("trabajo_actual");
                $informacionProfesional->tipo_institucion_id = $request->input("tipo_institucion");
                $informacionProfesional->nombre_empresa = $request->input("empresa");
                $informacionProfesional->actividad_empresa_id =  $request->input("actividad_empresa");
                $informacionProfesional->cargo_id =  $request->input("cargo");
                $informacionProfesional->tiempo_trabajo = $request->input("tiempo_laborando");
                $informacionProfesional->tipo_contrato_id = $request->input("tipo_contrato");
                $informacionProfesional->rango_sueldo = $request->input("rango_sueldo");
                $informacionProfesional->trabajo_exterior = $request->input("trabajo_exterior");
                $informacionProfesional->relacion_profesional_id = $request->input("relacion_carrera_profesional");
                $informacionProfesional->nivel_estudio = $request->input("nivel_estudio_acorde");
                $informacionProfesional->dificil_empleo = $request->input("dificultad_para_trabajar");
                $informacionProfesional->usuario_creacion = $user_id;
                $informacionProfesional->usuario_modificacion = $user_id;
                $informacionProfesional->save();
                $datos_profesionales = $informacionProfesional->id;

            // calificacion profesional
                
                $calificacionProfesion->calificacion = $request->input("formacion_profesional");
                $calificacionProfesion->porque = $request->input("formación_profesional_porque");
                $calificacionProfesion->usuario_creacion = $user_id;
                $calificacionProfesion->usuario_modificacion = $user_id;
                $calificacionProfesion->save();
                $calificacion_profesion = $calificacionProfesion->id;

            //calificacion docente 
                $calificacionDocente->dominio_asignatura = $request->input("calificacion_docente_dominio");
                $calificacionDocente->actualizacion_conocimiento = $request->input("calificacion_docente_actualizacion");
                $calificacionDocente->metodologia = $request->input("calificacion_docente_metodologia");
                $calificacionDocente->habilidades = $request->input("calificacion_docente_habilidades");
                $calificacionDocente->evaluacion = $request->input("calificacion_docente_evaluacion");
                $calificacionDocente->usuario_creacion = $user_id;
                $calificacionDocente->usuario_modificacion = $user_id;
                $calificacionDocente->save();
                $calificacion_docente = $calificacionDocente->id;
                

            // conocimientos adquiridos
            // descomponer el array para pasar aqui los datos 

            // pasar los datos del array 
                $conocimientosAdquiridos->materias_profesionales = $request->input("conocimientos_materias_profesionales") == 'on' ? 1 : 0;
                $conocimientosAdquiridos->materias_basicas =$request->input("conocimientos_materias_basicas") == 'on' ? 1 : 0;
                $conocimientosAdquiridos->comunicacion =$request->input("conocimientos_comunicacion") == 'on' ? 1 : 0;
                $conocimientosAdquiridos->otros = $request->input("conocimientos_otros") !== null ? 1 : 0 ;
                $conocimientosAdquiridos->idiomas =$request->input("conocimientos_idiomas") == 'on' ? 1 : 0;
                $conocimientosAdquiridos->descripcion_otros =$request->input("conocimientos_otros");
                $conocimientosAdquiridos->usuario_creacion =$user_id;
                $conocimientosAdquiridos->usuario_modificacion =$user_id;
                $conocimientosAdquiridos->save();
                $conocimientos_adquiridos = $conocimientosAdquiridos->id;

            //recursos carrera
                $recursosCarrera->talento = $request->input("recursos_de_la_carrera_talento");
                $recursosCarrera->infraestructura = $request->input("recursos_de_la_carrera_infraestructura");
                $recursosCarrera->servicio = $request->input("recursos_de_la_carrera_servicio");
                $recursosCarrera->ambiente = $request->input("recursos_de_la_carrera_ambiente");
                $recursosCarrera->usuario_creacion = $user_id;
                $recursosCarrera->usuario_modificacion = $user_id;
                $recursosCarrera->save();
                $recursos_carrera = $recursosCarrera->id;

            //areas de difucultad
                $areasDificultad->trabajo_equipo = $request->input("dificultad_general_trabajo_equipo");
                $areasDificultad->comunicacion_escrita = $request->input("dificultad_general_comunicacion_escrita");
                $areasDificultad->comunicacion_oral = $request->input("dificultad_general_comunicacion_oral");
                $areasDificultad->informatica = $request->input("dificultad_general_informatica");
                $areasDificultad->gestion = $request->input("dificultad_general_gestion");
                $areasDificultad->investigacion = $request->input("dificultad_general_investigacion");
                $areasDificultad->usuario_creacion = $user_id;
                $areasDificultad->usuario_modificacion = $user_id;
                $areasDificultad->save();
                $areas_dificultad = $areasDificultad->id;
            

            // preferencias estudio 
                $preferenciasEstudio->estudio_pregrado = $request->input("estudios_pregrado");
                $preferenciasEstudio->nueva_carrera = $request->input("otra_carrera") ;
                $preferenciasEstudio->recomendaria_institucion = $request->input("recomendar_institucion") ;
                $preferenciasEstudio->usuario_creacion = $user_id;
                $preferenciasEstudio->usuario_modificacion = $user_id;
                $preferenciasEstudio->save();
                $preferencias_estudio = $preferenciasEstudio->id;

            // temas interes
                $temasInteres->recomendacion1 = $request->input("temas_interes_r1");
                $temasInteres->recomendacion2 = $request->input("temas_interes_r2");
                $temasInteres->usuario_creacion = $user_id;
                $temasInteres->usuario_modificacion = $user_id;
                $temasInteres->save();
                $temas_interes = $temasInteres->id;
        
            // temas incluir
                $contenidoaIncluir->tema1 = $request->input("temas_incluir1");
                $contenidoaIncluir->tema2 = $request->input("temas_incluir2");
                $contenidoaIncluir->tema3 = $request->input("temas_incluir3");
                $contenidoaIncluir->usuario_creacion = $user_id;
                $contenidoaIncluir->usuario_modificacion = $user_id;
                $contenidoaIncluir->save();
                $contenido_incluir = $contenidoaIncluir->id;

            // asignatura 
                $asignatura->asignatura1 = $request->input("asignatura1");
                $asignatura->asignatura2 = $request->input("asignatura2");
                $asignatura->asignatura3 = $request->input("asignatura3");
                $asignatura->usuario_creacion = $user_id;
                $asignatura->usuario_modificacion = $user_id;
                $asignatura->save();
                $asignatura_incluir = $asignatura->id;


            // encuesta
                $encuesta->datos_personales_id = $datos_personales;
                $encuesta->informacion_profesional_id = $datos_profesionales;
                $encuesta->calificacion_profesion_id = $calificacion_profesion;
                $encuesta->calificacion_docente_id = $calificacion_docente;
                $encuesta->conocimiento_adquirido_id = $conocimientos_adquiridos;
                $encuesta->recursos_carreras_id = $recursos_carrera;
                $encuesta->area_dificultad_id = $areas_dificultad;
                $encuesta->relacion_desempeno_graduado_id = $request->input("relacion_desempeño_descripcion");
                $encuesta->preferencia_estudio_id = $preferencias_estudio;
                $encuesta->temas_interes_id = $temas_interes;
                $encuesta->contenidos_incluir_id = $contenido_incluir;
                $encuesta->asignatura_incluir_id =  $asignatura_incluir;//$asignatura_incluir;
                $encuesta->estado = 1;
                $encuesta->usuario_id = $user_id;
                $encuesta->usuario_creacion = $user_id;
                $encuesta->usuario_modificacion = $user_id;
                $encuesta->save();

                // actualizar la tabla de correos
                Correos::where('user_id',$user_id)->update(['estado' => '1']);


            //$datosPersonales->id;
            // hace un commit si todo sale bien
            DB::commit();
            $success = true;
        } catch (\Exception $e) {

            // hace un rollback si todo falla y envia un mensaje de error
            $success = false;
            $error = $e->getMessage();
            DB::rollback();
            dd($e);
        }

    }


    /**
     * Se encarga de validar si el usuario puede realizar la encuesta
     *
     * @return void
     */
    public function validarEncuesta($token = null,$promocion = null){

        $valido = Correos::whereYear('fecha_creacion',$this->getFecha())
            ->where([
                ['token',$token],
                ['promocion',$promocion]
            ])->get();

        // validar si existe el token con la promoción determinada
        if($valido->isEmpty() != 1){
            $estado = Correos::whereIn('estado',[0,1,2])->where([
                 ['token',$token],
                 ['promocion',$promocion]
             ])->get()->toArray();


            // Validar la acción que se debe realizar según el estado de la encuesta
            if($estado[0]['estado'] == '0'){
                 return view('modulos.encuesta.encuesta',compact('token'));
             }else if($estado[0]['estado'] == '1') {
                 $titulo = 'Lo sentimos la encuesta no esta disponible';
                 $mensaje = 'Usted ya ha respondido la encuesta del presente año.';
                return view('modulos.encuesta.errorEncuesta',compact('titulo','mensaje'));
             }else if($estado[0]['estado'] == '2'){
                 $titulo = 'Lo sentimos la encuesta no esta disponible';
                 $mensaje = 'Le enviaremos un correo electrónico cuando esta esté disponible.';
                 return view('modulos.encuesta.errorEncuesta',compact('titulo','mensaje'));
             }
        }else {
            $titulo = 'Error 404: Pagina no encontrada';
            $mensaje = 'La página que ha solicitado no se encuentra disponible.';
            return view('modulos.encuesta.errorEncuesta',compact('titulo','mensaje'));
        }



    }

    /**
     * Retorna el año actual
     *
     * @return date
     */
    public function getFecha(){
        $fecha = getdate();
        return $fecha['year'];
    }

    public function setFecha(){
        $month = date('m');
        $year = date('Y');
        $day = date("d", mktime(0, 0, 0, $month + 1, 0, $year));

        $fecha_fin = date('Y-m-d', mktime(0, 0, 0, 12, $day, $year));
        $fecha_inicio = date('Y-m-d', mktime(0, 0, 0, $month, 1, $year));

        $id_fecha = DB::table('tb_fecha')->insertGetId([
            'inicio' => $fecha_inicio, 'fin' => $fecha_fin, 'año' => $year
        ]); 

        return $id_fecha;
    }

    public function porcentajeEncuestados($year)
    {
        return $this->EncuestaProcedure->porcentajeEncuestados($year);
    }

    public function promociones(){
        $array = array();
        //consulto las promociones encuestas
        $promocionesEncuestadas = $this->promocionesEncuestadas();

        foreach ($promocionesEncuestadas as $promocion ){
            array_push($array,$promocion->promocion);
        }
        // consulta todos los registros de este año hacia atras que no se hayan enviado
        return DB::table('tb_promociones')->select('promocion')
                   ->where('promocion','<=', $this->getFecha())
                    ->whereNotIn('promocion',$array)->get();

    }

    public function promocionesEncuestadas(){
        return DB::table('tb_correos')->join('tb_fecha','tb_correos.fecha_id','=','tb_fecha.id')
                    ->select('tb_correos.promocion')->distinct()->where('tb_fecha.año','=',$this->getFecha())->get();
    }

    public function storePromocionesEnviadas($promociones) {
        // registra las promociones a las cuales se les envio la encuesta
        $promocion = new EncuestasEnviadas();
        foreach ($promociones as $value){
            $promocion->promocion = $value;
            $promocion->create_user_id = auth()->id();;
            $promocion->update_user_id = auth()->id();;
            $promocion->estado = 'enviada';
        }
    }

    /*
     * Por medio del id de las encuesta enviadas se obtiene la promoción para cancelar las encuestas enviadas
     * Luego de eso se desactiva las encuestas enviadas para que no sean tomadas en cuenta durane la creación de
     * los graficos.
     * return void
     */

    public function cancelarEncuesta($id)
    {
        $usuariosDesactivar = array();
        try{
            $promocion = EncuestasEnviadas::findOrFail($id);
            EncuestasEnviadas::where('id',$id)->update(['estado' => 'cancelado']);
            Correos::where('promocion',$promocion->promocion)->update(['estado' => '2']);
            $usuarios = Correos::where('promocion',$promocion->promocion)->get();

            foreach ($usuarios as $user){
                Encuesta::Where('usuario_creacion',$user->user_id)->update(['estado' => 0,]);
            }
        }catch (\Exception $e){
            echo  $e->getMessage();
        }
    }

    public function  promocionesEnviadas(){
       $enviadas = EncuestasEnviadas::whereYear('created_at',$this->getFecha())->get();

        return view('modulos.encuesta.administracion',compact('enviadas'));
    }




}
