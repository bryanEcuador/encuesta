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

        <div class="row">
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
        {{--  --}}
    <div class=" col-lg-6" id="content">
        <div class="tile">
            <h3>Recursos con los que cuenta la carrera</h3>
            <div id="grafico2">
                <canvas id="myChart2" class="embed-responsive-item" width="40vw" height="30vh"></canvas>
            </div>
            <div id="render"></div>
            <hr>
            <div class="container">
                <div class="row justify-content-center">
                    <button class="btn btn-success mx-2" onclick="descargarExcel('recursos_carrera')"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Descargar</button>
                    <button class="btn btn-danger mx-2"  onclick="descargarPdf('recursos_carrera')" ><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Descargar</button>
                    <button class="btn btn-secondary mx-2" onclick="imprimirPagina('recursos_carrera')"><i class="fa fa-print" aria-hidden="true"></i> Imprimir</button>
                </div>
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
        this.consultarGraficoB(yearValue);
    }

// funciones para cargar información
     
    function consultarGraficoA(year){
        var url = 'grafico/tipo_institucion/'+year;
         $.get(url, { crossDomain : true} , (data) =>  {
               this.graficoA(data)
            }).fail( function() {
                console.log("fallo la peticion");
        });

    }

    function consultarGraficoB(year) {
         var url = 'grafico/recursos_carrera/'+year;
         $.get(url, { crossDomain : true} , (data) =>  {
                console.log(data);
               this.graficoB(data)
            }).fail( function() {
                console.log("fallo la peticion");
        });
    }

    function consultarGraficoC(year) {
         var url = 'grafico/cargo/'+year;
         $.get(url, { crossDomain : true} , (data) =>  {
                console.log(data);
              // this.graficoC(data)
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

    function graficoB(datos){
        
        // talento 
        if(typeof(datos.talento[0].cantidad !== undefined)){
            console.log("talento");
            for(var i in datos.talento){
                if(datos.talento[i].talento == "excelente" ){
                var talentoExcelente = datos.talento[i].cantidad;

                } else if(datos.talento[i].talento == "muy buena"){
                    var talentoMuyBuena = datos.talento[i].cantidad;

                }else if(datos.talento[i].talento == "buena"){
                    var talentoBuena = datos.talento[i].cantidad;

                }else if(datos.talento[i].talento == "regular"){
                    var talentoRegular = datos.talento[i].cantidad;

                }else if(datos.talento[i].talento == "insuficiente"){
                    var talentoInsufuciente = datos.talento[i].cantidad;
                }
            }  
        }
        // servicios
       
         if(typeof(datos.servicios[0].cantidad !== undefined)){
        
            for(var i in datos.servicios){
                if(datos.servicios[i].servicio == "excelente" ){
                var serviciosExcelente = datos.servicios[i].cantidad;

                } else if(datos.servicios[i].servicio == "muy buena"){
                    var serviciosMuyBuena = datos.servicios[i].cantidad;

                }else if(datos.servicios[i].servicio == "buena"){
                    var serviciosBuena = datos.servicios[i].cantidad;
                    console.log(serviciosBuena+" servicios");

                }else if(datos.servicios[i].servicio == "regular"){
                    var serviciosRegular = datos.servicios[i].cantidad;

                }else if(datos.servicios[i].servicio == "insuficiente"){
                    var serviciosInsufuciente = datos.servicios[i].cantidad;
                }
            }  
        }
        //ambientes
        if(typeof(datos.ambiente[0].cantidad !== undefined)){
        
            for(var i in datos.ambiente){
                if(datos.ambiente[i].ambiente == "excelente" ){
                var ambienteExcelente = datos.ambiente[i].cantidad;

                } else if(datos.ambiente[i].ambiente == "muy buena"){
                    var ambienteMuyBuena = datos.ambiente[i].cantidad;

                }else if(datos.ambiente[i].ambiente == "buena"){
                    var ambienteBuena = datos.ambiente[i].cantidad;

                }else if(datos.ambiente[i].ambiente == "regular"){
                    var ambienteRegular = datos.ambiente[i].cantidad;

                }else if(datos.ambiente[i].ambiente == "insuficiente"){
                    var ambienteInsufuciente = datos.ambiente[i].cantidad;
                }
            }  
        }
        //infraestructura
        if(typeof(datos.infraestructura[0].cantidad !== undefined)){
        
            for(var i in datos.infraestructura){
                if(datos.infraestructura[i].infraestructura == "excelente" ){
                var infraestructuraExcelente = datos.infraestructura[i].cantidad;

                } else if(datos.infraestructura[i].infraestructura == "muy buena"){
                    var infraestructuraMuyBuena = datos.infraestructura[i].cantidad;

                }else if(datos.infraestructura[i].infraestructura == "buena"){
                    var infraestructuraBuena = datos.infraestructura[i].cantidad;

                }else if(datos.infraestructura[i].infraestructura == "regular"){
                    var infraestructuraRegular = datos.infraestructura[i].cantidad;

                }else if(datos.infraestructura[i].infraestructura == "insuficiente"){
                    var infraestructuraInsufuciente = datos.infraestructura[i].cantidad;
                }
            }  
        }


        (typeof(infraestructuraInsufuciente) == "number") ? infraestructuraInsufuciente : infraestructuraInsufuciente = 0 ;
        (typeof(infraestructuraRegular) == "number") ?  infraestructuraRegular = infraestructuraRegular: infraestructuraRegular = 0;
        (typeof(infraestructuraBuena) == "number") ? infraestructuraBuena = infraestructuraBuena : infraestructuraBuena = 0;
        (typeof(infraestructuraMuyBuena) == "number") ? infraestructuraMuyBuena = infraestructuraMuyBuena  : infraestructuraMuyBuena = 0 ;
        (typeof(infraestructuraExcelente) == "number") ? infraestructuraExcelente = infraestructuraExcelente  : infraestructuraExcelente = 0; 

         (typeof(ambienteInsufuciente) == "number") ? ambienteInsufuciente = ambienteInsufuciente : ambienteInsufuciente = 0 ;
        (typeof(ambienteRegular) == "number") ?  ambienteRegular = ambienteRegular: ambienteRegular = 0;
        (typeof(ambienteBuena) == "number") ? ambienteBuena = ambienteBuena : ambienteBuena = 0;
        (typeof(ambienteMuyBuena) == "number") ? ambienteMuyBuena = ambienteMuyBuena  : ambienteMuyBuena = 0 ;
        (typeof(ambienteExcelente) == "number") ? ambienteExcelente = ambienteExcelente  : ambienteExcelente = 0; 

         (typeof(serviciosInsufuciente) == "number") ? serviciosInsufuciente = serviciosInsufuciente : serviciosInsufuciente = 0 ;
        (typeof(serviciosRegular) == "number") ?  serviciosRegular = serviciosRegular: serviciosRegular = 0;
        (typeof(serviciosBuena) == "number") ? serviciosBuena = serviciosBuena : serviciosBuena = 0;
        (typeof(serviciosMuyBuena) == "number") ? serviciosMuyBuena = serviciosMuyBuena  : serviciosMuyBuena = 0 ;
        (typeof(serviciosExcelente) == "number") ? serviciosExcelente = serviciosExcelente  : serviciosExcelente = 0; 

        (typeof(talentoInsufuciente) == "number") ? talentoInsufuciente = talentoInsufuciente : talentoInsufuciente = 0 ;
        (typeof(talentoRegular) == "number") ?  talentoRegular = talentoRegular: talentoRegular = 0;
        (typeof(talentoBuena) == "number") ? talentoBuena = talentoBuena : talentoBuena = 0;
        (typeof(talentoMuyBuena) == "number") ? talentoMuyBuena = talentoMuyBuena  : talentoMuyBuena = 0 ;
        (typeof(talentoExcelente) == "number") ? talentoExcelente = talentoExcelente  : talentoExcelente = 0; 
        
           

         var ctx = document.getElementById("myChart2").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'radar',
            data: {
                labels: ["insuficiente","regular","buena","muy buena","excelente"],
                datasets: [{

                    label: 'Talento humano',
                    data: [talentoInsufuciente,talentoRegular,talentoBuena,talentoMuyBuena,talentoExcelente],
                    backgroundColor: [
                        'rgba(186, 231, 34  , 0.2)',
                    ],
                    borderColor: [
                        'rgba(186, 231, 34  ,1)',
                    ],
                    borderWidth: 1
                } ,
                {
                    label: 'servicios',
                       
                    data: [ 
                            0,0,0,0,0
                        ],
                    backgroundColor: [
                        'rgba(255, 99, 172, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255,99,172,1)',
                    ],
                    borderWidth: 1 
                },
                 {
                    label: 'infraestructura',
                    data: [ infraestructuraInsufuciente , infraestructuraRegular , infraestructuraBuena ,infraestructuraMuyBuena ,infraestructuraExcelente],
                    backgroundColor: [
                        'rgba(8, 240, 191  , 0.2)',
                    ],
                    borderColor: [
                        'rgba(8, 240, 191  ,1)',
                    ],
                    borderWidth: 1 
                },
                 {
                    label: 'ambiente',
                     data: [ambienteInsufuciente,ambienteRegular,ambienteBuena,ambienteMuyBuena,ambienteExcelente],
                    backgroundColor: [
                        'rgba(29, 51, 192, 0.2)',
                    ],
                    borderColor: [
                        'rgba(87, 107, 236  ,1)',
                    ],
                    borderWidth: 1 
                }

                ]
            },
            options: {
                
            }
        });
        
          
    
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
        }else if(id == "recursos_carrera" ){
            grafico = document.getElementById("myChart2");
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