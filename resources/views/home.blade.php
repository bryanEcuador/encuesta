@extends('layouts.administracion')
@section('nombre_pagina','Principal')
@section('Principal')
   <p>Gráficos</p>
@endsection
@section('css') 
@endsection
@section('title','Principal')

@section('contenido')
<div id="graficos" class="col-md-12">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="tile">
              <h4>Estado de la encuesta </h4> 
              <hr>
              <div class="alert alert-warning">
                  <p> La encuesta aun <strong>no</strong>  ha sido enviada</p>
              </div>
              <button class="btn btn-primary">Enviar Encuesta <i class="fa fa-envelope-o" aria-hidden="true"></i></button>

              <h5 class="text">Estado de correos enviados</h5>
                <canvas id="estado" width="400" height="400"></canvas>
            </div>
        </div>
    </div>
</div>


   
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <script>
var ctx = document.getElementById("estado").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'polarArea',
    data: {
        labels: ["Respondidas", "Faltantes"],
        datasets: [{
            data: [1, 99],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
               
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
            ],
            borderWidth: 1
        }]
    },
    options: {

    }
});
</script>
@endsection





{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
