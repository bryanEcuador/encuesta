@extends('layouts.administracion')
@section('nombre_pagina','Encuesta')
@section('Principal')
    <p>Encuesta</p>
@endsection
@section('title','Encuesta')

@section('contenido')

    <!-- Modal para el envio de las encuestas -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4  class="modal-title" id="myModalLabel">Encuestas</h4>
                </div>
                <div class="modal-body">
                    <div class="">
                        <h4 style="color: red"><i class="fa fa-exclamation-circle"></i>Esta seguro de cancelar la encuesta</h4>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">Cancelar encuesta</button>
                </div>
            </div>
        </div>
    </div>

   <div class="tile col-md-12" >
       <h3 class="tile-title">Encuestas enviadas este año</h3>
       <div class="table-responsive">
           <table class="table">
               <thead>
               <tr>
                   <th>Promoción</th>
                   <th>Fecha</th>
                   <th>Usuario</th>
                   <th>Acciones</th>
               </tr>
               </thead>
               <tbody>
               <tr>
                   <td>2019</td>
                   <td>19-03-2019</td>
                   <td>administrador</td>
                   {{--<td><button>Cancelar</button></td>--}}
                   <td><button class="btn btn-danger" data-toggle="modal" data-target="#myModal">Cancelar</button></td>
               </tr>

               </tbody>
           </table>
       </div>
   </div>
@endsection


