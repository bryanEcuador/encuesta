<?php

namespace App\Core\Procedimientos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Core\Modelos\UserLogs;
use App\Core\Modelos\TableLogs;
use app\User;

class LogProcedure extends Model
{
    public function getUsers() {
        return  User::all();
    }

    public function userLogs($user,$desde=null,$hasta=null) {
        $desde = $this->setDesde($desde);
        $hasta = $this->setHasta($hasta);

        if($desde){
            return
                UserLogs::where([
                ['user_id',$user],
                ['created_at', '>=' ,$desde],
                ['created_at', '<=' ,$hasta]
            ])->get();
        }

        //return UserLogs::where('user_id',$user)->get();
    }

    public function tableLogs($user,$table = null, $desde = null, $hasta = null)
    {
        $desde = $this->setDesde($desde);
        $hasta = $this->setHasta($hasta);
       if($desde){
           return TableLogs::where([
                [ 'user_id', $user],
               ['created_at', '>=' ,$desde],
               ['created_at', '<=' ,$hasta]
           ])->get();
       }
        return TableLogs::where('user_id', $user)->get();
    }

    public function getUserLogByDate($fecha, $user)
    {
        return TableLogs::where([
            ['user_id', 1],
            ['created_at','2018/12/25']
        ])->get();
    }

    public function getUserLogByTable($tabla, $fecha)
    {
        return TableLogs::where([
            ['tabla','user']
        ])->get();
    }

    public function getLogAllUser($user_id,$fecha)
    {
        $fechas = $this->addHoursToDate($fecha);

       return TableLogs::where([
           ['user_id',$user_id],
           ['created_at', '>=' , $fechas[0] ],
          ['created_at' ,'<=', $fechas[1]],
       ])->get();
    }


    public function getLogTable($tabla,$user,$desde = null,$hasta = null) {

        if($desde != null){

            return TableLogs::where([
                ['tabla',$tabla],
                ['user_id',$user],
                ['created_at', '>=' , $desde ],
                ['created_at' ,'<=', $hasta],
            ])->get();
        }

        return TableLogs::where([
            ['tabla',$tabla],
            ['user_id',$user]
        ])->get();
    }

    public function getLogAllTable()
    {
        return TableLogs::all();
    }

    public function addHoursToDate($fecha){
        $desde = $fecha.' 00:00:00' ;
        $hasta = $fecha.' 23:59:59';

        $fechas = array($desde,$hasta);
        return $fechas;
    }

    public function setDesde($desde){
        return $desde.' 00:00:00' ;
    }
    public function setHasta($hasta){
       return $hasta. '23:59:59';
    }


}