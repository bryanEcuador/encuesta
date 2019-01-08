<?php

namespace App\Http\Controllers;

use App\Exports\graficosExport;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use App\Notifications\EncuestaNotification;
use App\User;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Core\procedimientos\EncuestaProcedure;


class EncuestaController extends Controller
{
    use Notifiable;
    protected $EncuestaNotification;
    protected $EncuestaProcedure;

    public function __construct(EncuestaNotification $encuestaNotification, EncuestaProcedure $encuestaProcedure)
    {
        $this->EncuestaNotification = $encuestaNotification;
        $this->EncuestaProcedure = $encuestaProcedure;
    }

    // vista de los graficos todo
    public function index() {

        return view('modulos.graficos.graficos');
    }

    // descarga el excel de los graficos
    public function excel($tipo = null,$year = null){
        return Excel::download(new graficosExport(), 'users.xlsx');
    }

    // imprimir los graficos
    public function imprimir($tipo = null, $year = null)
    {
        if($tipo == "tipoInstitucion"){
            // voy a pedir datos por medio de un sp

            return view('imprimir.prueba');
        }
    }

    // consulta de graficos
    public function pdf($tipo = null){
       
    }

    // envia una notificación con el porcentaje de resultados
    public function notifify(){
        $encuestados = "200";
        $porcentaje = "75%";
        $user = auth()->user(); 
        $user->notify(new EncuestaNotification($encuestados,$porcentaje));

    }

    public function read() {
        
    }

    // funciones para cargar con info los graficos
    public function graficoA() {
        $datos = array(10,20,30);
        return $datos;
    }

    // consultas de la encuesta

     //Consultar nacionalidad
    public function getNacionalidadAll()
    {
        
        return $this->EncuestaProcedure->getNacionalidadAll();
    }
    //consultar genero
    public function getGeneroAll()
    {
        return $this->EncuestaProcedure->getGeneroAll();
    }

    // consultar carrera
    public function getCarreraAll()
    {
        return $this->EncuestaProcedure->getCarreraAll();
    }

    // estado civil
    public function getEstadoCivilAll()
    {
        return $this->EncuestaProcedure->getEstadoCivilAll();
    }

    // pais de residencia
    public function getPaisAll()
    {
        return $this->EncuestaProcedure->getPaisAll();
    }

    // etnia
    public function getEtniaAll()
    {
        return $this->EncuestaProcedure->getEtniaAll();
    }

    // tipo de institucion
    public function getInstitucionAll()
    {
        return $this->EncuestaProcedure->getInstitucionAll();
    }

    //cargo que ocupa
    public function getCargoAll()
    {
        return  $this->EncuestaProcedure->getCargoAll();
    }

    // rango de sueldo
    public function getRangoSueldoAll()
    {
       return  $this->EncuestaProcedure->getRangoSueldoAll();
    }

    //funcion para enviar correos para realizar la encuesta 
    
}
