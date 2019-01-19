<?php

namespace App\Core\Modelos;

use Illuminate\Database\Eloquent\Model;

class Encuesta extends Model
{
    //
    protected $table = "tb_encuesta";
    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = 'fecha_modificacion';
}
