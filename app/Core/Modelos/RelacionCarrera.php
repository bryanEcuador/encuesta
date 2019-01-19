<?php

namespace App\Core\Modelos;

use Illuminate\Database\Eloquent\Model;

class RelacionCarrera extends Model
{
    //
    protected $table = "tb_relacion_carrera_profesion";
    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = 'fecha_modificacion';
}
