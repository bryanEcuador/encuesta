<?php

namespace App\Core\Modelos;

use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    protected $table = "tb_asignaturas";
    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = 'fecha_modificacion';
}
