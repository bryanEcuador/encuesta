<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EncuestaController extends Controller
{
    public function index() {

        return view('modulos.graficos.graficos');
    }
}
