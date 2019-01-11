<?php

namespace App\Core\Procedimientos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GraficosProcedure extends Model
{
   // tipo institucion 
   public function tipoInstitucion($year){
    return DB::select('call sp_tipo_institucion(?)',array($year));
   }

   public function totalTipoInstitucion($year){
        return DB::select('call sp_total_institucion(?)', array($year));
   }

}