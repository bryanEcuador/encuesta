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

        var url = '/administracion/grafico/recursos_carrera/'+year;
         $.get(url, { crossDomain : true} , (data) =>  {
                this.graficoA(data)
            }).fail( function() {
                console.log("fallo la peticion");
        });

    }


// funciones para cargar graficos    
       function graficoA(datos) {
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


        (typeof(infraestructuraInsufuciente) == "number") ? infraestructuraInsufuciente = infraestructuraInsufuciente : infraestructuraInsufuciente = 0 ;
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
        
           

         var ctx = document.getElementById("myChart").getContext('2d');
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


</script>






@endsection