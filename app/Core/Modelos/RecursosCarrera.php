<?php

namespace App\Core\Modelos;

use Illuminate\Database\Eloquent\Model;

class RecursosCarrera extends Model
{
    protected $table = 'tb_recursos_carreras';
    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = 'fecha_modificacion';
}
