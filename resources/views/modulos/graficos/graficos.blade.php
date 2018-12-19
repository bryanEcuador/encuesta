@extends('layouts.administracion')
@section('nombre_pagina','Graficos')
@section('titulo de la pagina')
   <p>Gráficos</p>
@endsection
@section('css') 
    <style>
         canvas {
        /* width : 500px !important;
        height : auto !important; */
         }
    </style>
   
@endsection
@section('title','Graficos')

@section('contenido')
   
<div class=" col-lg-6">
    <div class="tile">
        <canvas id="myChart" width="40vw" height="30vh"></canvas>
        <hr>
        <button class="btn btn-success mx-2"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Descargar</button> 
        <button class="btn btn-danger mx-2"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Descargar</button> 
        <button class="btn btn-secondary mx-2"><i class="fa fa-print" aria-hidden="true"></i> Imprimir</button>
    </div>
</div>

<div class="col-lg-6">
    <div class="tile">
        <hr>
        <button>Descarar</button> <button>Descargar</button> <button>Imprimir</button>
    </div>
</div>
   
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
<script>
var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
     type: 'pie',
    data: {
        labels: ["Red", "Blue"],
        datasets: [{
            label: '# of Votes',
            data: [12, 19],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
            ],    
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        

        tooltips: {
            mode: 'point'
        },

         legend: {
            display: true,
            labels: {
                fontColor: 'rgb(255, 99, 132)'
            }
        },
        title: {
            display: true,
            text: 'Custom Chart Title',
            fontSize : '16',
        }
    }
});
</script>


@endsection