<?php

namespace App\Core\Modelos;

use Illuminate\Database\Eloquent\Model;

class CalificacionProfesion extends Model
{
    //
    protected $table = "tb_calificacion_profesion";
    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = 'fecha_modificacion';
}
