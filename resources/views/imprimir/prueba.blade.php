@extends('layouts.administracion')
@section('nombre_pagina','Imprimiento')
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

        <div class="">
            <h3>Tipo de institución que labora</h3>
            <div id="grafico1">
                <canvas id="myChart" class="embed-responsive-item" width="40vw" height="30vh"></canvas>
            </div>
        </div>

        <div class="texto">
            <p>Texto que se va a imprirmir como datos de la encuesta</p>
        </div>
    

</div>



   
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script>

    this.consultarGraficoA()

    setTimeout(this.imprimir,4000);

    function imprimir() {
         window.print();    
    }

    // funciones para cargar información
     
    function consultarGraficoA(){
        var year = 2019;

        var url = '/administracion/prueba/'+year;
         $.get(url, { crossDomain : true} , (data) =>  {
                console.log(data);
                this.graficoA(data)
            }).fail( function() {
                console.log("fallo la peticion");
        });

    }


// funciones para cargar graficos    
        function graficoA(datos) {
        // hacemos una petición a la url con la información

        //armamos el grafico
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["1","2","3"],
                datasets: [{
                    label: '# of Votes',
                    data: [datos[0], datos[1], datos[2]],
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


</script>






@endsection