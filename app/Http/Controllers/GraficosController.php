<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Core\Procedimientos\GraficosProcedure;
//use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\graficosExport;
use App\Exports\recursosCarreraExport;
use App\Exports\tipoInstitucionExport;



class GraficosController extends Controller
{
    protected $GraficosProcedure;
    // función inicial donde vamos a llamar a la clase que contiene
    // los metodos para llamar a los procedimientos almacenados
    public function __construct(GraficosProcedure $graficosProcedure)
    {
        $this->GraficosProcedure = $graficosProcedure; // inicialisamos las clase ahora ya podemos usar sus metodos
    }


    // vista principal de los graficos
    public function index(){
        return view('modulos.graficos.graficos');
    }

    // descargas de excel
    public function excel($tipo = null, $year = null)
    {
        if($tipo== "tipoInstitucion") {
            return Excel::download(new tipoInstitucionExport($year), 'tipoInstitucion.xlsx');
        }else if($tipo == "recursos_carrera"){
            return Excel::download(new recursosCarreraExport($year), 'recursosCarrera.xlsx');
        }
        
    }


    // pdf ?


    // imprimir los graficos
    public function imprimir($tipo = null, $year = null)
    {
        if ($tipo == "tipoInstitucion") {
            // voy a pedir datos por medio de un sp

            return view('imprimir.tipoinstitucion',compact('year'));
        }else if($tipo == "recursos_carrera" ){
            return view('imprimir.recursoscarrera', compact('year'));
        }
    }

     // funciones para cargar con info los graficos
    public function dibujarGrafico($tipo,$year)
    {
        // preguntamos que grafico necesitamos 
        // trae los datos y llama a una función para que los regrese en porcentaje
        if($tipo == "tipo_institucion" ){
             $datos = $this->GraficosProcedure->tipoInstitucion($year);
             $total = $this->GraficosProcedure->totalTipoInstitucion($year);
            $porcentaje = $this->porcentajeTipoInstitucion($datos,$total);
           return $porcentaje;
        }else if($tipo == "recursos_carrera"){

            $servicios = $this->GraficosProcedure->recursosCarreraServicios($year);
            $infraestructura = $this->GraficosProcedure->recursosCarreraInfraestructura($year);
            $ambiente = $this->GraficosProcedure->recursosCarreraAmbiente($year);
            $talento = $this->GraficosProcedure->recursosCarreraTalento($year);
            $total = $this->GraficosProcedure->totalRecursosCarrera($year);

            $porcentajeServicios = $this->porcentajeServicios($servicios,$total);
            $porcentajeInfraestrucutura = $this->porcentajeServicios($infraestructura,$total);
            $porcentajeAmbiente = $this->porcentajeServicios($ambiente,$total);
            $porcentajeTalento = $this->porcentajeServicios($talento,$total);

             $porcentajes = array('servicios' => $porcentajeServicios , 'ambiente' => $porcentajeAmbiente , 'infraestructura' => $porcentajeInfraestrucutura , 'talento' => $porcentajeTalento );
            
            return $porcentajes;

        }
        
    }


    // metodos para procesar información de los graficos

    public function porcentajeTipoInstitucion($datos , $total) {
        foreach ($datos as $value) {
            $value->total = ($value->total * 100) / $total[0]->cantidad;
        }

        return $datos;
    }

    public function porcentajeServicios($datos, $total)
    {
        //dd($datos);
        foreach ($datos as $value) {
            $value->cantidad = ($value->cantidad * 100) / $total[0]->cantidad;
        }

        return $datos;
    }

}
