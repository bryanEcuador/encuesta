<?php

namespace App\Core\Modelos;

use Illuminate\Database\Eloquent\Model;

class ConocimientosAdquiridos extends Model
{
    //
    protected $table = "tb_datos_personales";
    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = 'fecha_modificacion';
}
