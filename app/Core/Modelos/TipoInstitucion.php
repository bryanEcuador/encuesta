<?php

namespace App\Core\Modelos;

use Illuminate\Database\Eloquent\Model;

class TipoInstitucion extends Model
{
    protected $table = 'tb_tipo_institucion';
    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = 'fecha_modificacion';
}
