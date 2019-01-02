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
<div id="graficos" class="col-md-12">
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <input type="number" id="year" class="form-control" min="2018" max="2038">
                <button type="button" class="btn btn-warning mt-1">Consultar</button>
            </div>
        </div>
        </div>
        {{-- Grafico de tipo_institucion --}}
    <div class=" col-lg-6">
        <div class="tile">
            <canvas id="myChart" class="embed-responsive-item" width="40vw" height="30vh"></canvas>
            <hr>
            <div class="container">
                <div class="row justify-content-center">
                    <button class="btn btn-success mx-2" onclick="excel()"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Descargar</button>
                    <button class="btn btn-danger mx-2" onclick="pdf()"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Descargar</button>
                    <button class="btn btn-secondary mx-2" onclick="imprimir()"><i class="fa fa-print" aria-hidden="true"></i> Imprimir</button>
                </div>
            </div>


        </div>
    </div>

    </div>
</div>


   
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script>



    function cargarGraficos(){
        // obtenemos el año actual
        var yearValue = document.getElementById("year").value;
        if (yearValue === ''){
            var fecha = new Date();
            yearValue = fecha.getFullYear();

        }
        // llamamos a las funciones para dibujar los graficos
        this.graficoA(yearValue);
        this.esMayorDeEdad3();
    }


    function graficoA(year) {
        // hacemos una petición a la url con la información

        //armamos el grafico
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
    }

    function graficoB(){

    }

    this.cargarGraficos();


    function descargarExcel(grafico) {

    }
</script>

      




@endsection