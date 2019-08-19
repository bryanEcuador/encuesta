<?php


namespace App\Core\procedimientos;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;  


class EncuestaProcedure extends Model
{
    
    //Consultar nacionalidad
    public function getNacionalidadAll(){
        return    DB::table('tb_pais')->get(); // TODO: 
    }
    //consultar genero
    public function getGeneroAll()
    {
        return DB::table('tb_genero')->get();
    }

    // consultar carrera
    public function getCarreraAll()
    {
        return DB::table('tb_carrera')->get();
    }

    // estado civil
    public function getEstadoCivilAll()
    {
        return  DB::table('tb_estado_civil')->get();
    }

    // pais de residencia
    public function getPaisAll()
    {
        return DB::table('tb_pais')->get();
    }

    // etnia
    public function getEtniaAll()
    {
        return DB::table('tb_etnia')->get();
    }

    // tipo de institucion
    public function getInstitucionAll()
    {
        return   DB::table('tb_tipo_institucion')->get();
    }

    //cargo que ocupa
    public function getCargoAll()
    {
        return  DB::table('tb_tipo_cargo')->get();
    }

    // rango de sueldo
    public function getRangoSueldoAll()
    {
        return  DB::table('tb_rango_sueldo')->get();
    }

    public function porcentajeEncuestados($year)
    {
        return DB::select('call encuesta.sp_porc_correos_enviados(?)', array($year));
    }

}
