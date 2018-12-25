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
<div id="f" class="col-md-12">
    <div class="row">
        {{-- Grafico de tipo_institucion --}}
    <div class=" col-lg-6">
        <div class="tile">
            <canvas id="tipo_institucion" class="embed-responsive-item" width="40vw" height="30vh"></canvas>
            <hr>
            <div class="container">
                <div class="row justify-content-center">
                    <button class="btn btn-success mx-2"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Descargar</button> 
                    <button class="btn btn-danger mx-2"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Descargar</button> 
                    <button class="btn btn-secondary mx-2"><i class="fa fa-print" aria-hidden="true"></i> Imprimir</button>
                </div>
            </div>
            
        
        </div>
    </div>

    {{-- Grafico de --}}
    <div class=" col-lg-6">
        <div class="tile" id="graficos">
            <canvas id="myChart" width="40vw" height="30vh"></canvas>
            <hr>
            <div class="container">
                <div class="row justify-content-center">
                    <button class="btn btn-success mx-2"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Descargar</button> 
                    <button class="btn btn-danger mx-2"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Descargar</button> 
                    <button class="btn btn-secondary mx-2"><i class="fa fa-print" aria-hidden="true"></i> Imprimir</button>
                </div>
            </div>
            
        
        </div>
    </div> 

    {{-- Grafico de --}}
    <div class=" col-lg-6">
        <div class="tile">
            <canvas id="myChart" width="40vw" height="30vh"></canvas>
            <hr>
            <div class="container">
                <div class="row justify-content-center">
                    <button class="btn btn-success mx-2"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Descargar</button> 
                    <button class="btn btn-danger mx-2"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Descargar</button> 
                    <button class="btn btn-secondary mx-2"><i class="fa fa-print" aria-hidden="true"></i> Imprimir</button>
                </div>
            </div>
            
        
        </div>
    </div>

    {{-- Grafico de --}}
    <div class=" col-lg-6">
        <div class="tile">
            <canvas id="myChart" width="40vw" height="30vh"></canvas>
            <hr>
            <div class="container">
                <div class="row justify-content-center">
                    <button class="btn btn-success mx-2"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Descargar</button> 
                    <button class="btn btn-danger mx-2"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Descargar</button> 
                    <button class="btn btn-secondary mx-2"><i class="fa fa-print" aria-hidden="true"></i> Imprimir</button>
                </div>
            </div>
            
        
        </div>
    </div>

    {{-- Grafico de --}}
    <div class=" col-lg-6">
        <div class="tile">
            <canvas id="myChart" width="40vw" height="30vh"></canvas>
            <hr>
            <div class="container">
                <div class="row justify-content-center">
                    <button class="btn btn-success mx-2"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Descargar</button> 
                    <button class="btn btn-danger mx-2"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Descargar</button> 
                    <button class="btn btn-secondary mx-2"><i class="fa fa-print" aria-hidden="true"></i> Imprimir</button>
                </div>
            </div>
            
        
        </div>
    </div>

    {{-- Grafico de --}}
    <div class=" col-lg-6">
        <div class="tile">
            <canvas id="myChart" width="40vw" height="30vh"></canvas>
            <hr>
            <div class="container">
                <div class="row justify-content-center">
                    <button class="btn btn-success mx-2"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Descargar</button> 
                    <button class="btn btn-danger mx-2"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Descargar</button> 
                    <button class="btn btn-secondary mx-2"><i class="fa fa-print" aria-hidden="true"></i> Imprimir</button>
                </div>
            </div>
            
        
        </div>
    </div>

    {{-- Grafico de --}}
    <div class=" col-lg-6">
        <div class="tile">
            <canvas id="myChart" width="40vw" height="30vh"></canvas>
            <hr>
            <div class="container">
                <div class="row justify-content-center">
                    <button class="btn btn-success mx-2"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Descargar</button> 
                    <button class="btn btn-danger mx-2"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Descargar</button> 
                    <button class="btn btn-secondary mx-2"><i class="fa fa-print" aria-hidden="true"></i> Imprimir</button>
                </div>
            </div>
            
        
        </div>
    </div>

    {{-- Grafico de --}}
    <div class=" col-lg-6">
        <div class="tile">
            <canvas id="myChart" width="40vw" height="30vh"></canvas>
            <hr>
            <div class="container">
                <div class="row justify-content-center">
                    <button class="btn btn-success mx-2"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Descargar</button> 
                    <button class="btn btn-danger mx-2"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Descargar</button> 
                    <button class="btn btn-secondary mx-2"><i class="fa fa-print" aria-hidden="true"></i> Imprimir</button>
                </div>
            </div>
            
        
        </div>
    </div>
    </div>
</div>


   
@endsection
@section('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script> 
   {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script> --}}
      
<script>
var ctx = document.getElementById("tipo_institucion").getContext('2d');
var myChart = new Chart(ctx, {
     type: 'pie',
    data: {
        labels: ["Privada", "Publica","Familiar","Negocio/empredimiento","Propio","independiente"],
        datasets: [{
            label: 'Instituciones',
            data: [12, 19,34,56,65,78],
            backgroundColor: [
                'rgba(255, 99, 132, 0.9)',
                'rgba(54, 162, 235, 0.7)',
                'rgba(182, 233, 45, 0.2)',
                'rgba(213, 17, 213, 0.2)',
                'rgba(17, 213, 191, 0.2)',
                'rgba(217, 16, 173, 0.7)',
            ],    
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(255,99,132,1)',
                'rgba(255,99,132,1)',
                'rgba(255,99,132,1)',
                'rgba(255,99,132,1)',
                'rgba(255,99,132,1)',
               
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
            text: 'Tipo de institución',
            fontSize : '16',
        }
    }
});
  /*  var app = new Vue ({
       el: '#graficos',
       data: {
           institucionPrivada : 10,
           institucionPublica : 20,
           institucionFamiliar :15,
           institucionNegocio : 3,
           institucionPropio : 6,
           institucionIndepediente : 8,
       },
       
       created : function() {
          
            var ctx = document.getElementById("tipo_institucion").getContext('2d');
                var myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ["Privada", "Publica","Familiar","Negocio/empredimiento","Propio","independiente"],
                    datasets: [{
                        label: 'Instituciones',
                        data: [12, 19,34,56,65,78],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.9)',
                            'rgba(54, 162, 235, 0.7)',
                            'rgba(182, 233, 45, 0.2)',
                            'rgba(213, 17, 213, 0.2)',
                            'rgba(17, 213, 191, 0.2)',
                            'rgba(217, 16, 173, 0.7)',
                        ],    
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(255,99,132,1)',
                            'rgba(255,99,132,1)',
                            'rgba(255,99,132,1)',
                            'rgba(255,99,132,1)',
                            'rgba(255,99,132,1)',
                        
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
                        text: 'Tipo de institución',
                        fontSize : '16',
                    }
                }
            }); 
       },

       methods: {
           tipoInstitucion : function () {
                    var ctx = document.getElementById("tipo_institucion").getContext('2d');
                   
                    var myChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: ["Privada", "Publica","Familiar","Negocio/empredimiento","Propio","independiente"],
                        datasets: [{
                            label: 'Instituciones',
                            data: [12, 19,34,56,65,78],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.9)',
                                'rgba(54, 162, 235, 0.7)',
                                'rgba(182, 233, 45, 0.2)',
                                'rgba(213, 17, 213, 0.2)',
                                'rgba(17, 213, 191, 0.2)',
                                'rgba(217, 16, 173, 0.7)',
                            ],    
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(255,99,132,1)',
                                'rgba(255,99,132,1)',
                                'rgba(255,99,132,1)',
                                'rgba(255,99,132,1)',
                                'rgba(255,99,132,1)',
                            
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
                            text: 'Tipo de institución',
                            fontSize : '16',
                        }
                    }
                });
                 console.log(myChart);
           }
       },
   }) */
</script>
<script>
     var app = new Vue ({
       el: '#graficos',
       data: {
           institucionPrivada : 10,
           institucionPublica : 20,
           institucionFamiliar :15,
           institucionNegocio : 3,
           institucionPropio : 6,
           institucionIndepediente : 8,
       },
       
       created : function() {
          
            var ctx = document.getElementById("myChart").getContext('2d');
                var myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ["Privada", "Publica","Familiar","Negocio/empredimiento","Propio","independiente"],
                    datasets: [{
                        label: 'Instituciones',
                        data: [12, 19,34,56,65,78],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.9)',
                            'rgba(54, 162, 235, 0.7)',
                            'rgba(182, 233, 45, 0.2)',
                            'rgba(213, 17, 213, 0.2)',
                            'rgba(17, 213, 191, 0.2)',
                            'rgba(217, 16, 173, 0.7)',
                        ],    
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(255,99,132,1)',
                            'rgba(255,99,132,1)',
                            'rgba(255,99,132,1)',
                            'rgba(255,99,132,1)',
                            'rgba(255,99,132,1)',
                        
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
                        text: 'Tipo de institución',
                        fontSize : '16',
                    }
                }
            }); 
       },

       methods: {
        
       },
   })
</script>

@endsection