<?php

namespace App\Core\Modelos;

use Illuminate\Database\Eloquent\Model;

class ConocimientosAdquiridos extends Model
{
    //
    protected $table = "tb_conocimientos_adquiridos";
    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = 'fecha_modificacion';
}
