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
        <label style="display:none" id="year"> {{$year}}</label>
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
        var year = document.getElementById("year").textContent  ;

        var url = '/administracion/grafico/tipo_institucion/'+year;
         $.get(url, { crossDomain : true} , (data) =>  {
                this.graficoA(data)
            }).fail( function() {
                console.log("fallo la peticion");
        });

    }


// funciones para cargar graficos    
       function graficoA(datos) {
        //armamos el grafico
        var privada =  (datos.length >= 1)  ? datos[0].total : 0;
        var publica = (datos.length >= 2)  ? datos[1].total : 0;
        var familiar = (datos.length >= 3)  ? datos[2].total : 0;
        var propio = (datos.length >= 4)  ? datos[3].total : 0;
        var independiente = (datos.length >= 5)  ? datos[4].total : 0;

       
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ["publica","privada","negocio propio","familiar","independiente"],
                datasets: [{
                    label: '# of Votes',
                    data: [privada,publica,familiar,propio,independiente],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                
            }
        }); 
    }


</script>






@endsection