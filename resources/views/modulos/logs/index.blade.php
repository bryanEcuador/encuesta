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
                        <div class="table-responsive">
                            <table class="table">
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
                                <tr v-for="logs in AllLogs">
                                    <td>@{{logs.id}}</td>
                                    <td>@{{logs.user_id}}</td>
                                    <td>@{{logs.registro}}</td>
                                    <td>@{{logs.tabla}}</td>
                                    <td>@{{logs.accion}}</td>
                                    <td>@{{logs.created_at}}</td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                </div>

                <div class="tab-pane fade" id="usuario">
                     <div class="form-group">
                            <label>Usuario</label>
                            <select class="form-control"  v-model="user"  v-on:change="checkLogs">
                                <option v-for="user in users" :value="user.id"> @{{user.name}} </option>
                            </select>
                    </div>
                    <div class="row">
                            <div class="col-md-6">
                                <h2>Inicios de sesión</h2>

                                <div>
                                    <ul>
                                        {{-- <li v-for = "sesion in inicioSesion"><a :href="urlLogDate sesion.id"> @{{sesion.created_at | formatDate}} </a> <span class="badge badge-secondary">2</span> </li> --}}
                                        <li v-for = "sesion in inicioSesion"><button @click="openLinkSesion('sesion.id')" class="btn btn-link">@{{sesion.created_at | formatDate}}</button> <span class="badge badge-secondary">2</span> </li>
                                    </ul>
                                </div>
                            </div>  

                            <div class="col-md-6">
                            <h2>Modificaciones en tablas
                            </h2>
                            <div>
                                <ul>
                                        <li v-for="tables in modificacionesTablas"><a> @{{tables.tabla}} <span class="badge badge-secondary">2</span></a></li>
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
    <script src="{{asset('js/toastr.js')}}"></script>
    <script>
        var app = new Vue ({
            el :'#logs',
            data : {
                urlLogDate : 'urlLogDate/',
                user : '',
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
                logsUser : function (user) {
                    /* var urlLogsUsuario = 'logs/usuarios/'+usuario+'/{desde?}/{hasta?}' */
                    var urlLogsUsuario = 'logs/usuarios/'+usuario;
                    axios.get(urlLogsUsuario).then(response => {
                        this.inicioSesion = response.data
                    }).catch(error => {

                    })
                },

                logsTable : function () {
                    /* var urlLogTable = 'logs/tablas/{user}/{tabla?}/{desde?}/{hasta?}'*/
                    var urlLogTable = 'logs/tablas/'+this.user;
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

                openLinkSesion : function(link) {
                    var newLink = 'dir'
                   var etiqueta = document.createElement("a")
                   etiqueta.setAttribute("href","/www.google.com")
                   etiqueta.setAttribute("target","_black")
                   etiqueta.click()
                   console.log("click")
                   /*  document.createElement("button", {id: "mi-boton"}) */
                }
            },

            

        })
    </script>
  

@endsection