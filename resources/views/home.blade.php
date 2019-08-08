@extends('layouts.administracion')
@section('nombre_pagina','Principal')
@section('Principal')
   <p>Gráficos</p>
@endsection
@section('css') 
@endsection
@section('title','Principal')

@section('contenido')

    <!-- Modal para el envio de las encuestas -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4  class="modal-title" id="myModalLabel">Encuestas</h4>
                </div>
                <div class="modal-body">
                   <form id="enviar-encuesta" action="{{ route('enviar.correos') }}" method="POST">
                       {{ csrf_field() }}
                        <label class="label-primary">Enviar encuesta:</label>
                        <select name="promociones" class="form-control" id="promociones">
                            <option  value="todos" selected>Todas las promociones</option>
                            <option  value="grupo">Grupo</option>
                        </select>
                        <hr>
                        <div class="form-group" id="grupo_promociones" style="display:none;">
                            <label class="label-primary"> promocion 2017 <input class="form-control-label" type="checkbox" name="promocion1" value="2017"> </label><br>
                            <label class="label-primary"> promocion 2018 <input class="form-control-label" type="checkbox" name="promocion2" value="2018"> </label><br>
                            <label class="label-primary"> promocion 2019 <input class="form-control-label" type="checkbox" name="promocion3" value="2019"> </label>
                        </div>
                   </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
{{--
                    <button type="button" class="btn btn-primary">Enviar</button>
--}}
                    <a class="btn btn-primary" href="{{ route('enviar.correos') }}" onclick="event.preventDefault();
                        document.getElementById('enviar-encuesta').submit();">
                        Enviar
                        <i class="fa fa-envelope-o" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

<div id="graficos" class="col-md-12">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="tile">
              <h4>Estado de la encuesta </h4> 
              <hr>
|               <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                    Enviar encuesta
                </button>
               {{-- <a class="btn btn-primary" href="{{ route('enviar.correos') }}" onclick="event.preventDefault();
                        document.getElementById('enviar-encuesta').submit();">
                        Enviar Encuesta 
                            <i class="fa fa-envelope-o" aria-hidden="true"></i>
                </a>--}}
              {{--  <form id="enviar-encuesta" action="{{ route('enviar.correos') }}" method="GET" style="display: none;">

                </form>--}}
                
                <div id="enviarEncuesta" style="display:none">
                        <div class="alert alert-warning">
                            <p> La encuesta aun <strong>no</strong>  ha sido enviada</p>
                        </div>
                        <button class="btn btn-primary">
                            Enviar Encuesta 
                            <i class="fa fa-envelope-o" aria-hidden="true"></i>
                        </button>
                </div>

                    <div id="grafico" style="display:none">
                        <h5 class="text">Estado de correos enviados</h5>
                        <canvas id="estado" width="400" height="400"></canvas>
                    </div>  
            </div>
              
        </div>
    </div>
</div>


   
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <script>

var grafico = document.getElementById("grafico");
var enviarEncuesta = document.getElementById("enviarEncuesta");
let promociones = document.querySelector('#promociones');
let grupoPromociones = document.querySelector('#grupo_promociones');


promociones.addEventListener('change',function() {
   if( promociones.value == 'todos' ){
       grupoPromociones.style.display = 'none'
   } else if(promociones.value == 'grupo' ) {
       grupoPromociones.style.display = 'block'
   }
});

/* grafico.style.display = 'none'; */
/* enviarEncuesta.style.display = 'none'; */

this.consultarEncuestados()

    function obtenerYear() { 
            var fecha = new Date();
            yearValue = fecha.getFullYear();
            return   yearValue;   
    }

  function consultarEncuestados(){

       var year = this.obtenerYear();
        var url = 'porcentaje/encuesta/'+year;
         $.get(url, { crossDomain : true} , (data) =>  {
               this.graficar(data)
            }).fail( function() {
                console.log("fallo la peticion");
        });

    }


    function graficar(data) {
        
        if(data[0].porcentaje == 0){
            
             enviarEncuesta.style.display = 'block'; 
        } else {
             grafico.style.display = 'block'; 

             var diferencia = 100 - data[0].porcentaje;
            var ctx = document.getElementById("estado").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'polarArea',
                data: {
                    labels: ["Respondidas", "Faltantes"],
                    datasets: [{
                        data: [data[0].porcentaje, diferencia],
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
        }
       
    }



</script>
@endsection

