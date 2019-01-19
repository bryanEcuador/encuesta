<?php

namespace App\Core\Modelos;

use Illuminate\Database\Eloquent\Model;

class preferenciaEstudio extends Model
{
    //
    protected $table = "tb_preferencia_estudio";
    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = 'fecha_modificacion';
}
