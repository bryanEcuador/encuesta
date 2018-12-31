@extends('layouts.administracion')
@section('nombre_pagina','Logs de tablas')
@section('css')

@endsection
@section('titulo de la pagina','Logs')
{{-- @section('breadcrumbs')
    {{ Breadcrumbs::render('permisos') }}
@endsection --}}
@section('contenido')

    <div class="col-md-12" >
        <div class="tile" >
            <div class="col-md-8 offset-2 my-4" >
                <table class="table table-responsive" id="Table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Usuario</th>
                        <th>Registro</th>
                        <th>Tabla</th>
                        <th>Acccion</th>
                        <th>Fecha</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($datos as $logs )
                        <tr>
                            <td>{{$logs->id}}</td>
                            <td>{{$logs->user_id}}</td>
                            <td>{{$logs->registro}}</td>
                            <td>{{$logs->tabla}}</td>
                            <td>{{$logs->accion}}</td>
                            <td>{{$logs->created_at}}</td>
                        </tr>
                    @empty
                        <p> No existen datos </p>
                    @endforelse

                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
@section('js')
    <script type="text/javascript" src="/js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="/js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">

        $('#Table').DataTable(
            {
                "scrollX": true,
                "language": {

                    "lengthMenu": "Mostrar _MENU_ registros por pagina",
                    "zeroRecords": "Ningun registro encontrado ",
                    "info": "Mostrando pagina _PAGE_ de _PAGES_",
                    "infoEmpty": "Sin registros disponibles",
                    "infoFiltered": "(filtrando de un total de  _MAX_ registros)",
                    "search": "Buscar:",
                    paginate: {
                        first:      "Primero",
                        previous:   "Anterior",
                        next:       "Siguiente",
                        last:       "Ultimo"
                    },
                }
            }
        );
    </script>
    <script src="{{asset('js/toastr.js')}}"></script>
@endsection