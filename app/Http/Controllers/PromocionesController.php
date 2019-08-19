<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Core\Modelos\EncuestasEnviadas;

class PromocionesController extends Controller
{
    //

    /**
     * Inserta las promociones que han sido enviadas en la base
     * @return void
     */
    public function store($promociones = null) {
        $promocion = new EncuestasEnviadas();
        if($promociones != null) {
            foreach ($promociones as $value) {
                $promocion->promocion = $value;
                $promocion->create_user_id = auth()->id();
                $promocion->update_user_id = auth()->id();
                $promocion->estado = 'enviada';
                $promocion->save();
            }
        }else{
            $promociones = $this->todasPromociones();
            foreach ($promociones as $value) {
                $promocion->promocion = $value;
                $promocion->create_user_id = auth()->id();
                $promocion->update_user_id = auth()->id();
                $promocion->estado = 'enviada';
                $promocion->save();
            }
        }
    }


    /**
     * Devuelve todas las promociones menores a la fecha actual
     * @return array
     */
    public function todasPromociones(){
        return DB::table('tb_promociones')->select('promocion')
            ->where('promocion','<=', $this->getFecha())->get()->toArray();
    }

    /**
     * Devuelve todas las promociones menores a la fecha actual que no han sido seleccionadas
     * @return array
     */
    public function promociones(){
        $array = array();
        $promocionesEncuestadas = $this->promocionesEncuestadas();

        foreach ($promocionesEncuestadas as $promocion ){
            array_push($array,$promocion->promocion);
        }
        return DB::table('tb_promociones')->select('promocion')
            ->where('promocion','<=', $this->getFecha())
            ->whereNotIn('promocion',$array)->get();
    }

    /**
     * Devuelve todas las promociones que han sido encuestadas
     * @return array
     */
    public function promocionesEncuestadas(){
        return DB::table('tb_correos')->join('tb_fecha','tb_correos.fecha_id','=','tb_fecha.id')
            ->select('tb_correos.promocion')->distinct()->where('tb_fecha.año','=',$this->getFecha())->get();
    }

    public function  promocionesEnviadas(){
        $enviadas = EncuestasEnviadas::whereYear('created_at',$this->getFecha())->get();
        return view('modulos.encuesta.administracion',compact('enviadas'));
    }

    //TODO  cambiarla de lugar no corresponde al titulo de la clase
    public function getFecha(){
        $fecha = getdate();
        return $fecha['year'];
    }

}
