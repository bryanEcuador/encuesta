<?php
namespace App\Http\Traits;
use App\Core\Modelos\UserLogs;
use App\Core\Modelos\TableLogs;
use app\User;
/**
 * 
 */
trait logTrait
{
    public function userLog($user){

    }

    public function tableLog($table,$action,$user){

    }

    public function llamada(){
        echo "hola";
    }
}
