<?php

namespace App\Http\Controllers;

use App\Exports\graficosExport;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use App\Notifications\EncuestaNotification;
use App\User;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

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
    }

    public function notifify(){
        $encuestados = "200";
        $porcentaje = "75%";
        $user = auth()->user(); 
        $user->notify(new EncuestaNotification($encuestados,$porcentaje));

    }

    public function read() {
        
    }
}
