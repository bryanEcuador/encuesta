<?php

namespace App\Core\Modelos;

use Illuminate\Database\Eloquent\Model;

class InformacionProfesional extends Model
{
    //
    protected $table = "tb_informacion_profesional";
    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = 'fecha_modificacion';
}
