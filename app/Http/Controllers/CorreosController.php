<?php

namespace App\Http\Controllers;


use function GuzzleHttp\Psr7\get_message_body_summary;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use App\Notifications\EncuestaNotification;
use App\Mail\EncuestaMail;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Jobs\ProcessUsersMail;
use App\Jobs\ProcessMailEncuesta;
use App\Http\Controllers\PromocionesController;



use App\Core\Modelos\Correos;


use Illuminate\Support\Facades\Mail;

class CorreosController extends Controller
{

    use Notifiable;
    protected $EncuestaNotification;
    protected $EncuestaMail;
    protected  $promocion;


    public function __construct(EncuestaNotification $encuestaNotification,EncuestaMail $encuestaMail)
    {
        $this->EncuestaNotification = $encuestaNotification;
        $this->EncuestaMail = $encuestaMail;
        $this->promocion = new PromocionesController();
    }


    /**
     * Este metodo recibe un request desde la vista con las promociones a las que debe enviar la encuesta
     * crea un arreglo con los estudiantes de las promociones que se deben de enviar
     * guarda en la base de datos los registros a enviar y posteriormente los envia por el correo electronico configurado
     *
     * * Para enviar los correos se debe ejecutar el JOB
     * @return hacia la vista con el mensaje de exito
     */
    public function enviarEncuesta(Request $request) {


        try {
            $user = $this->getDatos($request);
            ProcessUsersMail::dispatch($user,$this->setFecha());
            ProcessMailEncuesta::dispatch();
            $estado = 1;

            return redirect()->route('home',['estado' => $estado]);
        }catch (\Exception $e){
            echo $e->getMessage();
            $estado = 2;
            return redirect()->route('home',['estado' => $estado]);
        }
    }

    /**
     * retorna los estudiantes a los cuales se les va a enviar la encuesta
     * @return collecion
     */
    public function getUser($tipo,$elementos = null){
        $estudiantes_id = array();
        try{
            $users = DB::table('role_user')->select('user_id')->where('role_id','=',5)->get();
            foreach($users as $user){
                array_push($estudiantes_id,$user->user_id) ;
            }

            if($tipo == 1){
                //TODO se puede refactorizar
                $array = array();
                $promocionesEncuestadas = $this->promocion->promocionesEncuestadas();
                if($promocionesEncuestadas !== null){
                    foreach ($promocionesEncuestadas as $promocionValue ){
                        array_push($array,$promocionValue->promocion);
                    }
                }
                $estudiantes = User::whereIn('id',$estudiantes_id)->whereNotIn('promocion',$array)->get()->toArray();
            }else if($tipo == 2){
                $estudiantes = User::whereIn('id',$estudiantes_id)->WhereIn('promocion',$elementos)->get()->toArray();
            }else{
                $estudiantes = null;
            }

            return $estudiantes;
        }catch(\Exception $e){
            echo 'Excepción capturada: ',  $e->getMessage(), "\n"; //TODO
        }

    }

    /**
     * Ingresa la fecha de  envio de  las enncuestas a la base de datos
     * @return number
     */
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

    /**
     * Selecciona los datos de entrada y los procesa
     * @return collecion
     */
    public function getDatos(Request $request){
        try {
            $array = array_map(null,$request->input());

            if($request->input('promociones') == 'todos'){
                $user = $this->getUser(1);
                $this->promocion->storePromocionesEnviadas();
            }else {
                $promociones = array_filter($array, function($var){
                    if(is_numeric($var)){
                        return $var;
                    }
                });
                $this->promocion->storePromocionesEnviadas($promociones);
                $user = $this->getUser(2,$promociones);
            }
        }catch (\Exception $e){
            echo $e->getMessage();
        }

        return $user;
    }



}
