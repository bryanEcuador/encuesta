<?php

namespace App\Core\Modelos;

use Illuminate\Database\Eloquent\Model;

class NivelCargoTrabajo extends Model
{
    //
    protected $table = "tb_nivel_estudio_cargo_trabajo";
    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = 'fecha_modificacion';
}
