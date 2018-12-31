@extends('layouts.administracion')
@section('nombre_pagina','Logs')
@section('css')

@endsection
@section('titulo de la pagina','Logs')
{{-- @section('breadcrumbs')
    {{ Breadcrumbs::render('permisos') }}
@endsection --}}
@section('contenido')

<div class="col-md-12" id="logs" >
        <div class="tile" v-cloak>
            <div class="col-lg-12">
            <div class="bs-component">
              <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#generales">Generales</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#usuario">Por usuario</a></li>                
              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade active show" id="generales">
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

                <div class="tab-pane fade" id="usuario">
                     <div class="form-group my-4">
                            <label>Usuario</label>
                            <select class="form-control"  v-model="user"  v-on:change="checkLogs">
                                <option v-for="user in users" :value="user.id"> @{{user.name}} </option>
                            </select>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label>Desde:</label>
                            <input class="form-control" type="date" v-model="desde">
                        </div>
                        <div class="col-md-6">
                            <label>Hasta:</label>
                            <input class="form-control" type="date" v-model="hasta">
                        </div>
                    </div>
                    <div class="row">
                            <div class="col-md-6">
                                <h2>Inicios de sesión</h2>

                                <div>
                                    <ul>
                                        {{-- <li v-for = "sesion in inicioSesion"><a :href="urlLogDate sesion.id"> @{{sesion.created_at | formatDate}} </a> <span class="badge badge-secondary">2</span> </li> --}}
                                        <li v-for = "sesion in inicioSesion"><button @click="openLinkSesion(sesion.id,sesion.created_at)" class="btn btn-link">@{{sesion.created_at | formatDate}}</button> <span class="badge badge-secondary">2</span> </li>
                                    </ul>
                                </div>
                            </div>  

                            <div class="col-md-6">
                            <h2>Modificaciones en tablas
                            </h2>
                            <div>
                                <ul>
                                    <li v-for = "tables in modificacionesTablas"><button @click="openLinkTable(tables.tabla)" class="btn btn-link"> @{{tables.tabla}}</button> <span class="badge badge-secondary">2</span> </li>
                                </ul>
                            </div>
                            </div>
            </div>
                </div>
              </div>
            </div>
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
    <script>
        var app = new Vue ({
            el :'#logs',
            data : {
                urlLogDate : 'urlLogDate/',
                user : '',
                desde: '',
                hasta : '',
                inicioSesion : [],
                users :[],
                modificacionesTablas : [],
                descripcionSesiones : [],
                descripcionTablas : [],
                AllLogs : [],
            },

            created : function() {
               this.loadUser()
               this.LogsTableAll()
            },

            computed: {
                
            },

            filters : {
                formatDate : function(date) {
                    return date.substring(0,10) 
                }
            },

            methods: {
                LogsTableAll : function () {
                     var urlLogs = 'logs/all';
                    axios.get(urlLogs).then(response => {
                        this.AllLogs = response.data
                    }).catch(error => {

                    })
                },
                logsUser : function () {
                    if(this.desde === '' && this.hasta == '' ){
                        var urlLogsUsuario = 'logs/usuarios/'+this.user;
                    } else {
                        if(this.desde === '' && this.hasta !== ''){
                            this.desde = this.hasta
                        } else {
                            this.hasta = this.desde
                        }
                        var urlLogsUsuario = 'logs/usuarios/'+this.user+'/'+this.desde+'/'+this.hasta;
                    }
                    axios.get(urlLogsUsuario).then(response => {
                        this.inicioSesion = response.data
                    }).catch(error => {

                    })
                },

                logsTable : function () {
                    if(this.desde === '' && this.hasta == '' ){
                        var urlLogTable = 'logs/tablas/'+this.user;
                    } else {
                        if(this.desde === '' && this.hasta !== ''){
                            this.desde = this.hasta
                        } else {
                            this.hasta = this.desde
                        }
                        var urlLogTable  = 'logs/usuarios/'+this.user+'/'+this.desde+'/'+this.hasta;
                    }
                    /* var urlLogTable = 'logs/tablas/{user}/{tabla?}/{desde?}/{hasta?}'*/

                    axios.get(urlLogTable).then(response => {
                        this.modificacionesTablas = response.data
                    }).catch(error => {
                        this.logsTable();
                    });
                },

                loadUser : function () {
                    var urlUser = 'obtener-usuarios'
                    axios.get(urlUser).then(response => {
                        this.users = response.data 
                    }).catch(error => {
                        this.loadUser();
                    })
                },

                checkLogs : function () {
                this.logsUser();
                this.logsTable();
                },

                openLinkSesion : function(id,fecha) {
                    var newFecha =  fecha.substring(0,10)
                    var newLink = 'user/logs/all/'+id+'/'+newFecha;
                   var etiqueta = document.createElement("a")
                   etiqueta.setAttribute("href",newLink)
                   etiqueta.setAttribute("target","_black")
                   etiqueta.click()
                   console.log("click")
                   /*  document.createElement("button", {id: "mi-boton"}) */
                },

                openLinkTable : function(table) {
                    if(this.desde === '' && this.hasta == '' ){
                        var newLink = 'table/log/'+table+'/'+this.user;
                    } else {
                        if(this.desde === '' && this.hasta !== ''){
                            this.desde = this.hasta
                        } else {
                            this.hasta = this.desde
                        }
                        var newLink = 'table/log/'+table+'/'+this.user+'/'+this.desde+'/'+this.hasta;
                    }
                    var etiqueta = document.createElement("a")
                    etiqueta.setAttribute("href",newLink)
                    etiqueta.setAttribute("target","_black")
                    etiqueta.click()
                    console.log("click")
                    /*  document.createElement("button", {id: "mi-boton"}) */
                }
            },

            

        })
    </script>
  

@endsection