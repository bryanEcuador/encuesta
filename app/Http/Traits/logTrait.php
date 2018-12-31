<?php
namespace App\Http\Traits;
use App\Core\Modelos\UserLogs;
use App\Core\Modelos\TableLogs;
use app\User;

/**
* Guardar logs en la base de datos
 */
trait logTrait
{
    public function userLog(){

        $userLogs = new UserLogs;
        $userLogs->user_id = auth()->id();
        $userLogs->save();
    }

    public function tableLog($table,$action,$registro){
        $userTable = new TableLogs();
        $userTable->tabla = $table;
        $userTable->accion =$action;
        $userTable->registro = $registro;
        $userTable->user_id = auth()->id();
        $userTable->save();
    }

}
