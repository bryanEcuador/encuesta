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
                <button type="button" id="consultar" class="btn btn-warning mt-1">Consultar</button>
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
                    <button class="btn btn-success mx-2" onclick="descargarExcel('tipoInstitucion')"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Descargar</button>
                    <button class="btn btn-danger mx-2"  onclick="descargarPdf('tipoInstitucion')" ><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Descargar</button>
                    <button class="btn btn-secondary mx-2" onclick="imprimirPagina('tipoInstitucion')"><i class="fa fa-print" aria-hidden="true"></i> Imprimir</button>
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
    <script src="//cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>

<script>

// codigo en JS Puro a base de funciones    

//funcion de inicio 
this.cargarGraficos();

// funciones para porcesamiento

    function obtenerYear() {
        var yearValue = document.getElementById("year").value;
        if (yearValue === ''){
            var fecha = new Date();
            yearValue = fecha.getFullYear();
            return   yearValue;   
        }
        return   yearValue;
    }

     function cargarGraficos(){
        // obtenemos el año actual
        var yearValue = this.obtenerYear();
        // llamamos a las funciones para dibujar los graficos
        this.consultarGraficoA(yearValue);
    }

// funciones para cargar información
     
    function consultarGraficoA(year){
        var url = 'grafico/tipo_institucion/'+year;
         $.get(url, { crossDomain : true} , (data) =>  {
                console.log(data);
                //this.graficoA(data)
            }).fail( function() {
                console.log("fallo la peticion");
        });

    }


// funciones para cargar graficos    
        function graficoA(datos) {
        //armamos el grafico
        var privada = datos[0].total ;
        var publica = datos[1].total;
        var familiar = datos[2].total;
        var propio = datos[3].total;
        var independiente = datos[4].total;

        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ["publica","privada","negocio propio","familiar","independiente"],
                datasets: [{
                    label: '# of Votes',
                    data: [datos[0], datos[1], datos[2]],
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
     function descargarExcel(grafico) {
        
        var link = document.createElement("a");
        var year = this.obtenerYear();
        var dir = "excel/"+grafico+"/"+year;   
        link.setAttribute("href",dir);
        link.click();

    }

// funciones para PDF

    function descargarPdf(id) {
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
    function imprimirPagina(grafico) {        
        var link = document.createElement("a");
        var year = this.obtenerYear();
        var dir = "imprimir/"+grafico+"/"+year;  
        link.setAttribute("href",dir);
        link.setAttribute("target","_black");
        link.click();
        
    }

// consultar por año

    consultar.addEventListener("click", () => {
        this.cargarGraficos();
    });
   


</script>






@endsection