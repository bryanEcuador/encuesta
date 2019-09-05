<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Core\Modelos\EncuestasEnviadas;
use Illuminate\Support\Facades\DB;


class PromocionesController extends Controller
{
    //

    /**
     * Inserta las promociones que han sido enviadas en la base
     * @return void
     * @return void
     */
    public function storePromocionesEnviadas($promociones = null) {

        if($promociones != null) {

            foreach ($promociones as $value) {
                $promocion = new EncuestasEnviadas();
                $promocion->promocion = $value;
                $promocion->create_user_id = auth()->id();
                $promocion->update_user_id = auth()->id();
                $promocion->estado = 'enviada';
                $promocion->save();
            }
        }else{
            $promocionesNoEnviadas = $this->todasPromocionesNoEnviadas();

            foreach ($promocionesNoEnviadas as $value) {
                $promocion = new EncuestasEnviadas();
                $promocion->promocion = $value->promocion;
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
    public function todasPromocionesNoEnviadas(){
        //TODO CODIGO REPETIDO EN LA SECCIÓN DE ABAJO REFACTORIZAR EN UN NUEVO METODO
        $promocionesEnviadas = array();

        $encuestasEnviadas = DB::table('tb_encuestas_enviadas')->select('promocion')->whereYear('created_at','=',$this->getFecha())
            ->get()->toArray();

        foreach ($encuestasEnviadas as $value){
            array_push($promocionesEnviadas ,$value->promocion);
        }

        return DB::table('tb_promociones')->select('promocion')
            ->where('promocion','<=', $this->getFecha())
            ->whereNotIn('promocion',$promocionesEnviadas )
            ->get()->toArray();

    }

    /**
     * Devuelve todas las promociones menores a la fecha actual que no han sido seleccionadas
     * @return array
     */
    public function promociones(){
        //$array = array();
        //$promocionesEncuestadas = $this->promocionesEncuestadas();

        //foreach ($promocionesEncuestadas as $promocion ){
         //   array_push($array,$promocion->promocion);
        //}

        $promocionesEnviadas = array();

        $encuestasEnviadas = DB::table('tb_encuestas_enviadas')->select('promocion')->whereYear('created_at','=',$this->getFecha())
            ->get()->toArray();

        foreach ($encuestasEnviadas as $value){
            array_push($promocionesEnviadas ,$value->promocion);
        }

        return DB::table('tb_promociones')->select('promocion')
            ->where('promocion','<=', $this->getFecha())
            ->whereNotIn('promocion',$promocionesEnviadas)->get();
    }

    /**
     * Devuelve todas las promociones que han sido encuestadas
     * @return array
     */
    public function promocionesEncuestadas(){
        //return DB::table('tb_correos')->join('tb_fecha','tb_correos.fecha_id','=','tb_fecha.id')
          //  ->select('tb_correos.promocion')->distinct()->where('tb_fecha.año','=',$this->getFecha())->get();
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
