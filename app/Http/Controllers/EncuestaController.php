<?php

namespace App\Http\Controllers;

use App\Exports\graficosExport;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use App\Notifications\EncuestaNotification;
use App\User;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use  Dompdf\Dompdf;


class EncuestaController extends Controller
{
    use Notifiable;
    protected $EncuestaNotification;

    public function __construct(EncuestaNotification $encuestaNotification)
    {
        $this->EncuestaNotification = $encuestaNotification;
    }

    public function index() {

        return view('modulos.graficos.graficos');
    }

    public function excel($tipo = null){
        return Excel::download(new graficosExport(), 'users.xlsx');
    }
    public function pdf($tipo = null){
        //return Excel::download(new graficosExport(), 'users.xlsx');
       /* $pdf = \PDF::loadView('pdf.prueba');
        return $pdf->download('invoice.pdf');*/
        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml('');
// (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
        $dompdf->render();

// Output the generated PDF to Browser
        $dompdf->stream();
    }

    public function notifify(){
        $encuestados = "200";
        $porcentaje = "75%";
        $user = auth()->user(); 
        $user->notify(new EncuestaNotification($encuestados,$porcentaje));

    }

    public function read() {
        
    }

    public function graficoA() {
        $datos = array(10,20,30);
        return $datos;
    }
}
