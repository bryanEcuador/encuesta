<?php

namespace App\Core\Modelos;

use Illuminate\Database\Eloquent\Model;

class ContenidoaIncluir extends Model
{
    //
    protected $table = "tb_contenido_incluir";
    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = 'fecha_modificacion';
}
