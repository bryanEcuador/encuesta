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

   // cargo que ocupa
   public function totalCargo($year){
      return DB::select('call sp_total_cargos(?)', array($year));
   }

   public function tipoCargo($year){
      return DB::select('call sp_cargos(?)', array($year));

   }
   // relacion carrera profesional 

   public function relacion_carrera_profesional($year){
      return DB::select('call sp_relacion_carrera_profesion(?)', array($year));
   }

   // recursos carrera
   public function totalRecursosCarrera($year){
      return DB::select('call sp_total_recursos_carrera(?)', array($year));
   }

   public function recursosCarreraServicios($year){
      return DB::select('call sp_recurso_carrera_servicio(?)', array($year));
   }

   public function recursosCarreraInfraestructura($year)
   {
      return DB::select('call sp_recurso_carrera_infraestructura(?)', array($year));
   }

   public function recursosCarreraAmbiente($year)
   {
      return DB::select('call sp_recurso_carrera_ambiente(?)', array($year));
   }


   public function recursosCarreraTalento($year)
   {
      return DB::select('call sp_recurso_carrera_talento(?)', array($year));
   }
}