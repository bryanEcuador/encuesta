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
        if($desde != null){
            return 0;
        }

        return UserLogs::where('user_id',1)->get();
    }

    public function tableLogs($user,$table = null, $desde = null, $hasta = null)
    {
       if($desde == null and $table !==null){
        
       }else if($desde != null and $table == null){

       }

        return TableLogs::where('user_id', 1)->get();

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

    public function getLogAllUser($user_id)
    {
       return User::find(1)->logUser;
    }

    public function getLogAllTable()
    {
        // obtener todos los logs del sistema

    }
}