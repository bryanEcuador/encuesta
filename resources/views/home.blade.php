@extends('layouts.administracion')
@section('nombre_pagina','Principal')
@section('Principal')
   <p>Gráficos</p>
@endsection
@section('css') 
@endsection
@section('title','Principal')

@section('contenido')
<div id="graficos" class="col-md-12">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="tile">
              <h4>Estado de la encuesta </h4> 
              <hr>
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

/* grafico.style.display = 'none'; */
/* enviarEncuesta.style.display = 'none'; */
console.log("hola");
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

