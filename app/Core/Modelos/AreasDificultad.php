<?php

namespace App\Core\Modelos;

use Illuminate\Database\Eloquent\Model;

class AreasDificultad extends Model
{
    //
    protected $table = "tb_area_dificultad";
    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = 'fecha_modificacion';
}
