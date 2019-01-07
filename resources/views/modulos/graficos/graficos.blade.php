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
    <div class=" col-lg-6" id="content">
        <div class="tile">
            <h3>Tipo de institución que labora</h3>
            <div id="grafico1">
                <canvas id="myChart" class="embed-responsive-item" width="40vw" height="30vh"></canvas>
            </div>
            <div id="render"></div>
            <hr>
            <div class="container">
                <div class="row justify-content-center">
                    <button class="btn btn-success mx-2" onclick="excel()"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Descargar</button>
                    <button class="btn btn-danger mx-2" id="download" onclick="pdf('tipoInstitucion')" ><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Descargar</button>
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
    <script src="https://code.jquery.com/jquery-1.12.3.min.js"></script>
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/0.9.0rc1/jspdf.min.js"></script>--}}
    <script src="//cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>

<script>

// codigo en JS Puro a base de funciones    

//funcion de inicio 
this.cargarGraficos();

// funciones para porcesamiento

     function cargarGraficos(){
        // obtenemos el año actual
        var yearValue = document.getElementById("year").value;
        if (yearValue === ''){
            var fecha = new Date();
            yearValue = fecha.getFullYear();

        }
        // llamamos a las funciones para dibujar los graficos
        this.consultarGraficoA(yearValue);

    }

// funciones para cargar información
     
    function consultarGraficoA(year){
        console.log(year)

        var url = 'prueba/'+year;
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

    function graficoB(){

    }
    function graficoC(){

    }
    function graficoD(){

    }
    function graficoE(){

    }
    function graficoF(){

    }
    function graficoG(){

    }
    function graficoH(){

    }




// funciones para excel


// funciones para PDF

    function pdf(id) {
        var grafico ;
        if(id == "tipoInstitucion"){
           grafico = document.getElementById("myChart");
        }
        // aquí va el resto de opciones


        if( grafico != undefined){
            // procesamiento del grafico
         html2canvas(grafico).then(canvas => {

             var doc = new jsPDF();
              doc.setFontSize(20);
              doc.text(20, 25, 'Informe de .....');
             doc.addImage(canvas,'JPEG',20,40); // x y
             doc.setFontSize(12);
             doc.text(20,135,'Aqui va el texto del informe final');
             doc.save();
         });

        }
        
    }



//funciones para imprimir




  ownload.addEventListener("click", function() {

         html2canvas(document.getElementById("myChart")).then(canvas => {

             var doc = new jsPDF();
              doc.setFontSize(20);
              doc.text(20, 25, 'Informe de .....');
             doc.addImage(canvas,'JPEG',20,40); // x y
             doc.setFontSize(12);
             doc.text(20,135,'Aqui va el texto del informe final');
             doc.save();
         });
  });







   




   


    function descargarExcel(grafico) {

    }


</script>






@endsection