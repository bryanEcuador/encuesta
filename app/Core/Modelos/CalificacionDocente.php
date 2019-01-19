<?php

namespace App\Core\Modelos;

use Illuminate\Database\Eloquent\Model;

class CalificacionDocente extends Model
{
    //
    protected $table = "tb_calificacion_docente";
    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = 'fecha_modificacion';
}
