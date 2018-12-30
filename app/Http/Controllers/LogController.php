<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Core\Procedimientos\LogProcedure;
use App\Http\Traits\logTrait;

class LogController extends Controller
{
    protected $LogProcedure;
    use logTrait;

    public function __construct(LogProcedure $logProcedure)
    {
        $this->LogProcedure = $logProcedure;
    }

    public function index(){
        return view('modulos.logs.index');
    }

    public function storeLogUser(){
        $this->llamada();
    }

    public function storeLogTable() {
        $logTrait = new logTrait;
        $logTrait->llamada();
    }


    /*
|--------------------------------------------------------------------------
| Logs
|--------------------------------------------------------------------------
|Consultas de las difetentes tablas de logs
| 
| 
|
     */

    public function userLogs($user,$desde=null ,$hasta=null){
        //obtener los logs de las fechas de ingresos de los usuarios
       return $this->LogProcedure->userLogs($user,$desde,$hasta);
    }

    public function getUser(){
        //obtener todos los usarios del sistema
       return  $this->LogProcedure->getUsers();
    }

    public function tableLogs($user , $tabla=null,$desde=null,$hasta=null){
        //obtner todas las tablas que hayan sido modifcadas por el usuario
        return $this->LogProcedure->tableLogs($user,$tabla, $desde, $hasta);
    }

    public function getUserLogByDate($fecha,$user) {
        //obtener el log de un día en particular
        return $this->LogProcedure->getUserLogByDate($fecha, $user);
    }

    public function getUserLogByTable($tabla,$fecha) {
        //obtener los log de una tabla por usuario
        return $this->LogProcedure->getUserLogByTable($tabla, $fecha);
    }

    public function getLogAllUser($user_id){
        // obtener todos los logs del sistema
        /* return $this->LogProcedure->getLogAllUser($user_id); */
        dd($this->LogProcedure->getLogAllUser($user_id));

    }

    public function getLogAllTable()
    {
        // obtener todos los logs del sistema
        return $this->LogProcedure->getLogAllTable();
    }
}
