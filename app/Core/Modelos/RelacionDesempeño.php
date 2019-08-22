<?php

namespace App\Core\Modelos;

use Illuminate\Database\Eloquent\Model;

class  RelacionDesempeño extends Model
{
    //
    protected $table = "tb_relacion_desempeno_graduado";
    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = 'fecha_modificacion';
}
