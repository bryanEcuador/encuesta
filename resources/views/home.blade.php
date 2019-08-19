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
                        <label class="label-primary">Enviar encuesta a:</label>
                        <select name="promociones"  class="form-control" id="promociones">
                            <option  value="todos" selected>Todas las promociones</option>
                            <option  value="grupo">Grupo de promociones</option>
                        </select>
                        <hr>
                        <div class="form-group" id="grupo_promociones" style="display:none;">
                        </div>
                   </form>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-primary" href="{{ route('enviar.correos') }}" onclick="event.preventDefault();
                        document.getElementById('enviar-encuesta').submit();">
                        Enviar
                        <i class="fa fa-envelope-o" aria-hidden="true"></i>
                    </a>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
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
                    <div id="respuesta">

                    </div>
                    <div id="enviarEncuesta" style="display:none">
                            <div class="alert alert-success">
                                <p>Todas las encuesta de este año ya han sido enviadas.</p>
                            </div>
                    </div>

                    <div id="grafico" style="display:none">
                        <h5 class="text">Estado de correos enviados</h5>
                        <canvas id="estado" width="400" height="400"></canvas>
                    </div>

                <button id="btnEncuestas" type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                    Enviar encuesta
                </button>

            </div>
              
        </div>
    </div>
</div>


   
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <script>

var grafico = document.getElementById("grafico");
let enviarEncuesta = document.getElementById("enviarEncuesta");
let promociones = document.querySelector('#promociones');
let grupoPromociones = document.querySelector('#grupo_promociones');
let btnEncuestas = document.querySelector('#btnEncuestas');
let respuesta = document.querySelector('#respuesta');

this.consultarEncuestados()
this.consultarEstadoEncuestas()
this.consultarRespuesta();


function consultarRespuesta() {
    if(@json($estado !== null)){
        console.log(@json($estado))
        let elemento = document.createElement('div')
        elemento.classList = 'alert alert-success'
        elemento.innerText = 'Las encuestas han sido enviadas con exito'
        respuesta.appendChild(elemento)

        setTimeout(function() {
            respuesta.removeChild(elemento);
        },5000)
    }
}

promociones.addEventListener('change',function() {
   if( promociones.value == 'todos' ){
       grupoPromociones.style.display = 'none'
   } else if(promociones.value == 'grupo' ) {
       grupoPromociones.style.display = 'block'
       consultarPromociones();
   }
});


/* grafico.style.display = 'none'; */
/* enviarEncuesta.style.display = 'none'; */



    function  consultarEstadoEncuestas() {
        var url = '/promociones';

        $.get(url, { crossDomain : true} , (data) =>  {
            if(data.length == 0){
                this.enviarEncuesta.style.display = 'block'
                this.btnEncuestas.style.display = 'none'
            }
        }).fail( function() {
            console.log("fallo la peticion");
        });
    }
    function consultarPromociones(){
        var url = '/promociones';
            $.get(url, { crossDomain : true} , (data) =>  {
                this.crear(data)
                }).fail( function() {
                console.log("fallo la peticion");
            });
    }

    function crear(data){
        //recorrer para crear los elementos
        let etiqueta;
        let opcion;
        let contador = 0;
        data.forEach(function(element){
            contador +=1;
          etiqueta = document.createElement('label');
          etiqueta.classList = 'label-primary';
          etiqueta.textContent = 'Promoción'+' '+element.promocion+' '
          opcion = document.createElement('input');
          opcion.classList = 'form-control-label';
          opcion.value = element.promocion;
          opcion.setAttribute('name','promocion'+contador);
          opcion.setAttribute('type','checkbox');
          etiqueta.appendChild(opcion);

          grupoPromociones.appendChild(etiqueta)
            grupoPromociones.appendChild(document.createElement('br'));
        });
    }

    function obtenerYear() { 
            var fecha = new Date();
            yearValue = fecha.getFullYear();
            return   yearValue;   
    }

  function consultarEncuestados(){

       var year = this.obtenerYear();
        var url = '/porcentaje/encuesta/'+year;
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

