<?php

namespace App\Core\Modelos;

use Illuminate\Database\Eloquent\Model;

class UserLogs extends Model
{
    protected $table = 'tb_ingreso_log';

    public function user(){
        return $this->belongsTo('App\User');
    }
}
