@extends('layouts.administracion')
@section('nombre_pagina','usuarios')
@section('css')
<link rel="stylesheet" href="{{asset('css/toastr.css')}}">
<style>
[v-cloak] {
  display: none;
}


@media screen and (max-width:768px){
    .nombre {
        margin-top : 5px;

    }
}
</style>
@endsection
@section('titulo de la pagina','usuarios')
{{-- @section('breadcrumbs')
    {{ Breadcrumbs::render('usuarios') }}
@endsection --}}
@section('contenido')
 <div class="col-md-12" id="usuarios"  >
        <div class="tile" v-cloak>
            <div class="col-md-12">
                <button class="btn btn-primary btn-lg-3 col-lg-3 col-md-12 mb-2" data-toggle="modal" data-target="#crearUsuario"> Crear </button>
            </div>
            
            <div v-if="vistaBusqueda == true" class="form-group row">
                <label class="form-control-label col-md-1 col-12 my-2" for="name">Buscar:</label>
                <select class="col-lg-4 col-lg-4 form-control mx-1 " v-model="rol_consulta" id="b_roles" v-on:change = "consultarNombreUsuario(undefined)">
                    <option value="0"></option>
                    <option v-for="item in cmbRoles" :value="item.id"> @{{item.name}}</option>
                </select>

                <input  type="text"   class="form-control nombre col-lg-4 " placeholder="nombre" v-model="usuario_consulta" v-on:keyup.13="consultarNombreUsuario(undefined)">
            </div>
            <br>
            <div>
                <div  v-if="vistaOpcionesTabla == true" class="form-inline ">
                     <div class="form-group col-md-5 col-12 mb-2 ">
                        <label>Mostrar:</label>
                        <select v-on:change="changeNumberPage" v-model="datosPorPagina" class="form-control mx-1">
                           <option  v-for="cantidad in cantidadPorPagina"> @{{cantidad}} </option>
                        </select>
                    </div>
                    <div  class="form-group col-md-5 col-12 mb-2 ">
                        <label>Ordenar:</label>
                        <select v-on:change="ordenar" v-model="orden" class="form-control mx-1">
                            <option value="asc">Ascendente</option>
                            <option value="desc">Descendente</option>
                        </select>
                    </div>
                </div>

                <hr>
                <div v-if="vistaTabla == true" class="col-sm-12 col-sm-offset-2" style="background-color:white;">
                <table class="table table-hover table-bordered"  >
                    <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr v-for="dato in usuariosTable">
                            <td>@{{dato.name}}</td>
                            <td>@{{dato.rol}}</td>
                            <td>
                                    <button type="button" class="btn btn-info" v-on:click="ver(dato.id)">Ver</button>
                                    <button type="button" class="btn btn-success" v-on:click="editar(dato.id)">Actualizar</button>
                                    <button type="button" class="btn btn-danger" v-on:click="suprimir(dato.id)">Eliminar</button>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Usuario</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                    </tfoot>
                </table>
                <div class="form-inline" v-if="vistaPaginacion === true">
                    <div class="col-md-4">
                        <span> @{{ paginacion.to }} de @{{paginacion.total}} registros</span>
                    </div>

                    <div class="col-md-8" >
                        <div>
                             <!-- corregir -->
                            <ul class="pagination">
                                <li class="page-item" v-if="paginacion.current_page > 1">
                                    <a class="page-link" href="#" @click.prevent="changePage(paginacion.current_page - 1 )" >
                                        <i class="fa fa-angle-left"></i>
                                    </a>
                                </li>
                                <li class="page-item" v-for="page in pagesNumber" v-bind:class="[ page == isActived ? 'page-item active' : 'page-item']">
                                    <a class="page-link" href="#" @click.prevent="changePage(page)"  >@{{page}}</a>
                                </li>
                                <li class="page-item" v-if="paginacion.current_page < paginacion.last_page"  >
                                    <a class="page-link" href="#"  @click.prevent="changePage(paginacion.current_page + 1 )">
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
                <div v-else="">
                  <p class="alert alert-danger">No existen <strong>usuarios</strong> registrados</p>
                </div>
            </div>
             
           
        <!-- modales -->
        <div id="crearUsuario" class="modal fade" role="dialog" >
            <div class="modal-dialog modal-lg">
                <div class="col-lg-12">
                    <div class="bs-component">
                        <div class="modal" style="position: relative; top: auto; right: auto; left: auto; bottom: auto; z-index: 1; display: block;">
                          <form id="frmGuardar" name="frmGuardar" method="POST" action="{{ route('register') }}">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Creación de usuarios</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="form-group">
                                            <input type="text" class="form-control" v-model="usuario" id="usuario"  name="usuario" placeholder="nombre_usuario" autocomplete="off">
                                        </div>

                                        <div class="form-group">
                                            <input type="text" class="form-control" v-model="email"  placeholder="email del usuario" autocomplete="off">
                                        </div>

                                        <div class="form-group">
                                            <input type="password" class="form-control" v-model="pass" id="pass" name="pass"  placeholder="Contraseña" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" v-model="pass2" id="pass2"  placeholder="Confirmacion de Contraseña" autocomplete="off">
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-2" >Rol</label>
                                            <div class=" col-md-10">
                                                <select class="form-control"  id="roles" name="rol" v-model="rol">
                                                    <option v-for="item in cmbRoles" :value="item.id"> @{{item.name}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div>
                                            <label class="control-label col-md-2">Promoción</label>
                                            <input class="form-control" v-model="promocion" type="number" min="2010" max="{{date('Y') + 1}}">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary" type="button" v-on:click="validar">Guardar</button>
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                          </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="vistaUsuarios" class="modal fade" role="dialog" >  
            <div class="modal-dialog modal-lg">
                <div class="col-lg-12">
                    <div class="bs-component">
                        <div class="modal" style="position: relative; top: auto; right: auto; left: auto; bottom: auto; z-index: 1; display: block;">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Usuarios</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <label class="label-text"> Usuario:</label>
                                        <div class="form-group">
                                            <input type="text" readonly class="form-control" v-model="v_usuario" id="v_usuario" placeholder="Nombres" autocomplete="off">
                                        </div>
                                        <label class="label-text"> Email:</label>
                                        <div class="form-group">
                                            <input type="text" readonly class="form-control" v-model="v_email" >                                        </div>

                                        <label class="label-text col-md-6"> Rol:</label>
                                        <div class="form-group">
                                            <select class="form-control" id="rol_view" v-model="v_role" >
                                                <option v-for="item in cmbRoles" :value="item.id"> @{{item.name}} </option>
                                            </select>
                                        </div>
                                        <label class="label-text"> Fecha creacion:</label>
                                        <div class="form-group">
                                            <input type="text" readonly class="form-control" v-model="v_fechac" id="v_fechaoc" placeholder="Nombres" autocomplete="off">
                                        </div>
                                        <label class="label-text"> Fecha modificacion:</label>
                                        <div class="form-group">
                                            <input type="text" readonly class="form-control" v-model="v_fecham" id="v_fecham" placeholder="Nombres" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="editarUsuarios" class="modal fade" role="dialog" >
            <div class="modal-dialog modal-lg">
                <div class="col-lg-12">
                    <div class="bs-component">
                        <div class="modal" style="position: relative; top: auto; right: auto; left: auto; bottom: auto; z-index: 1; display: block;">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Usuarios</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <label class="label-text"> Usuario:</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" v-model="e_usuario" id="e_usuario" placeholder="Nombres" autocomplete="off">
                                        </div>
                                        <label class="label-text"> Email:</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" v-model="e_email"  placeholder="Nombres" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" v-model="e_pass" id="e_pass" name="pass"  placeholder="Contraseña" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" v-model="e_pass2" id="e_pass2"  placeholder="Confirmacion de Contraseña" autocomplete="off">
                                        </div>
                                        <label class="label-text"> Promoción:</label>
                                        <div class="form-group">
                                            <input type="number" class="form-control" v-model="e_promocion"   placeholder="Promoción" autocomplete="off">
                                        </div>

                                        <div class="col-md-12">
                                            <label class="label-text col-md-6"> Rol:</label>
                                        </div>
                                        <div class=" col-md-10">
                                            <select class="form-control" id="e_roles" name="rol" v-model="e_roles" :value="e_roles">
                                                 <option v-for="item in cmbRoles" :value="item.id"> @{{item.name}} </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary" type="button" v-on:click="actualizar">Actualizar</button>
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="{{asset('js/toastr.js')}}"></script>
     <script>
        var app = new Vue ({
            el:'#usuarios',
            data : {
                /* combos */
                cmbRoles : [],
                /* tabla */
                usuariosTable : [],
                /* variables para guardar  */      
                email : '',
                rol :'',
                usuario : '',
                pass : '',
                pass2 : '',
                promocion : '',
                
                /* Carga de información */
                usuarios_s : [],
                usuarios_e : [],
                // modelos
                
                //visualizar
                v_id  : '',
                v_usuario : '',
                v_tipo : '',
                v_role : '',
                v_fechac : '',
                v_fecham :'',
                v_email : '',
                
                //editar
                e_id  : '',
                e_usuario : '',
                e_rol : '',
                e_pass : '',
                e_pass2 : '',
                e_roles : '',
                e_email : '',
                e_promocion:'',
                /* Validaciones */
                errores : [],
                respuesta1 : [],
                respuesta2 : [],
                respuesta1_update : [],
                respuesta2_update : [],

                /* busqueda */
                rol_consulta : 0,
                usuario_consulta : '',

                 /* paginacion */
                paginacion : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to': 0,
                },
                offset: 3,
                vistaBusqueda : false,
                vistaOpcionesTabla : false,
                vistaTabla : false,
                vistaPaginacion : false,
                cantidadDatos : false,
                datos : [],
                valor : '',
                tipo : '',

                 /* orden de la tabla */
                orden :'asc',
                datosPagina : [],
                datosPorPagina : 5,


            },

            created : function() {
                this.loadUsuarios();     
                this.consultarRoles();
            },
            computed : {
                isActived : function () {
                    return this.paginacion.current_page;
                },
                pagesNumber: function() {

                    if(!this.paginacion.to){
                        return [];
                    }
                    var from = this.paginacion.current_page - this.offset;
                    if(from < 1){
                        from = 1;
                    }
                    var to = from + (this.offset * 2);
                    if(to >= this.paginacion.last_page){
                        to = this.paginacion.last_page;
                    }
                    var pagesArray = [];
                    while(from <= to){
                        pagesArray.push(from);
                        from++;
                    }
                    return pagesArray;
                },
                datosNumber : function() {

                    return this.paginacionTable.length;
                },
                cantidadPorPagina : function () {
                
                   var inicial = 0;
                    var datos = [];

                   while(true) {
                         inicial = inicial + 5;
                        if(this.paginacion.total <= inicial) { 
                           break;
                       } else {
                           this.datosPorPagina = 5;
                         datos.push(inicial)
                       }
                      
                   }  
                    return datos;           
                },
            },

            methods : {

                //------------------------------------ CONSULTAS -----------------------------------//
                consultarRoles : function() {
                    var url = '/seguridad/usuarios/roles';
                            axios.get(url).then(response => {
                                    this.cmbRoles = response.data;
                                
                                }).catch(error => {
                                    console.log(error);
                                    this.consultarRoles();
                            });
                },
                //------------------------------------ /CONSULTAS -----------------------------------//
                 //------------------------------------ PAGINACION -----------------------------------//
                    loadUsuarios : function(page) {
                        console.log(page);
                        var url = page !== undefined ?  '/seguridad/usuarios/datos/'+this.datosPorPagina+'/'+page : '/seguridad/usuarios/datos/'+this.datosPorPagina;
                        axios.get(url).then(response => {
                            
                                        this.datos = response.data;
                                        if(this.datos.length <= 5 || this.datos == 0) {
                                            this.vistaBusqueda = false;
                                            this.vistaOpcionesTabla = false;
                                            if(this.datos == 0){
                                                this.datosConsulta = false;
                                                this.vistaTabla = false;
                                                this.vistaPaginacion = false;
                                            } else {
                                                this.vistaTabla = true;
                                                this.usuariosTable = this.datos;
                                            }

                                        } else {
                                            this.vistaTabla = true;
                                            this.vistaBusqueda = true;
                                            this.vistaOpcionesTabla = true;
                                            this.vistaPaginacion = true;
                                            this.cantidadDatos = true;

                                            this.usuariosTable = this.datos.data;
                                            this.paginacion.total = this.datos.total;
                                            if (page == undefined) {
                                                this.paginacion.current_page = this.datos.current_page;
                                            }
                                            this.paginacion.per_page = this.datos.per_page;
                                            this.paginacion.last_page = this.datos.last_page;
                                            this.paginacion.from = this.datos.from;
                                            this.paginacion.to = this.datos.to;

                                        }
                            }).catch(error => {
                                console.log(error);
                                this.loadUsuarios();
                        });
                },
                 changePage: function(page) {
                    this.paginacion.current_page = page;
                    this.usuario_consulta === '' && this.rol_consulta == 0 ? this.loadUsuarios(page) : this.consultarNombreUsuario(page);
                },

                changeNumberPage :function(page) {
                    this.usuario_consulta === '' ? this.loadUsuarios(page) : this.consultarNombreUsuario(page);
                },
                //------------------------------------ /PAGINACION -----------------------------------//
                //------------------------------------ CRUD -----------------------------------//
                    
                crear : function() {
                    $url = '/seguridad/usuarios/store';
                        axios.post($url, {
                                name : this.usuario.toLowerCase(),
                                email : this.email.toLowerCase(),
                                password : this.pass,
                                password_confirmation : this.pass2,
                                rol : this.rol,
                                promocion : this.promocion
                        
                            }).then(response => {
                                if(response.data[0] == "Error") {
                                    if(response.data[1] == 1062) {
                                        toastr.error("El nombre se encuentra duplicado");
                                    } else {
                                        toastr.error("Error al guardar "+this.mensaje);
                                    }
                                } else {
                                     $("#crearUsuario").modal('hide');
                                    toastr.success('Usuario con exito.', 'Exito', {timeOut: 5000});
                                    this.limpiar();
                                    this.loadUsuarios();
                                 }

                            }).catch(response => {
                                toastr.error( "Error al momento de guardar "+this.mensaje);
                                console.log(response);
                                if(response.status === 422)
                                {
                                    var errors = $.parseJSON(response.responseText);
                                    $.each(errors, function (key, value) {
                                        if($.isPlainObject(value)) {
                                            $.each(value, function (key, value) {
                                                toastr.error('Error en el controlador: '+value+'', 'Error', {timeOut: 5000});
                                                console.log(key+ " " +value);
                                            });
                                        }else{
                                            toastr.error('Error '+response+' al momento de crear el permiso.', 'Error', {timeOut: 5000});
                                        }
                                    });
                                }
                        });

                },
                 ver :function (id) {
                    var show = '/seguridad/usuarios/show/'+id;
                    axios.get(show).then(response => {
                        this.usuarios_s  = response.data;
                    //this.v_id = this.usuarios_s[0].;
                    this.v_usuario = this.usuarios_s[0].name;
                    this.v_email = this.usuarios_s[0].email;
                    this.v_fechac = this.usuarios_s[0].fecha_creacion;
                    this.v_fecham = this.usuarios_s[0].fecha_actualizacion;
                    this.v_role = this.usuarios_s[0].rol;
                    })

                    $("#vistaUsuarios").modal('show');
                },
                 editar :function (id) {
                    this.v_id = id;
                    var show = '/seguridad/usuarios/show/'+id+'';
                    axios.get(show).then(response => {
                    this.usuarios_e  = response.data;
                    this.e_id = id;
                    this.e_email = this.usuarios_e[0].email;
                    this.e_usuario = this.usuarios_e[0].name;
                    this.e_roles = this.usuarios_e[0].rol;
                    this.e_promocion = this.usuarios_e[0].promocion;
                    })

                    $("#editarUsuarios").modal('show');
                },
                //------------------------------------ /CRUD -----------------------------------//
                 //------------------------------------ VALIDACIONES -----------------------------------//
                //------------------------------------ /VALIDACIONES -----------------------------------//
                //------------------------------------ FUNCIONES -----------------------------------//
                     ordenar : function() {
                        if(this.orden == 'asc' ) {
                            this.usuariosTable.sort(function (a, b) {
                            if (a.name > b.name) {
                                return 1;
                            }
                            if (a.name < b.name) {
                                return -1;
                            }
                            // a must be equal to b
                            return 0;
                            });

                        } else if(this.orden == 'desc') {
                            this.usuariosTable.sort(function (a, b) {
                            if (a.name < b.name) {
                                return 1;
                            }
                            if (a.name > b.name) {
                                return -1;
                            }
                            // a must be equal to b
                            return 0;
                            });

                        }
                    },
                    limpiar: function () {
                            this.usuario = '';
                            this.email = '';
                            this.pass = '';
                            this.pass2 = '';
                    },
                //------------------------------------ / FUNCIONES -----------------------------------//


                consultarNombreUsuario: function (page) {
                        console.log(page);
                        //alert(page);
                    if( this.rol_consulta == 0 && this.usuario_consulta == '') {
                        this.loadUsuarios();
                    } else {
                        var url = '';
                        if(page === undefined)
                        {
                            url = '/seguridad/usuarios/datos/'+this.datosPorPagina+'/'+0+'/'+this.rol_consulta+'/'+this.usuario_consulta;
                        }else{
                            url = '/seguridad/usuarios/datos/'+this.datosPorPagina+'/'+page+'/'+this.rol_consulta+'/'+this.usuario_consulta; 
                        }
                            console.log(url);
                        
                        axios.get(url).then(response => {
         
               
                                this.datos = response.data;
                                this.vistaBusqueda = true;
                                 if(this.datos.length <= this.datosPorPagina || this.datos == 0) {
                                           
                                              this.vistaPaginacion = false;
                                              this.vistaOpcionesTabla = false;
                                            if(this.datos == 0){
                                                this.vistaTabla = false;
                                            } else {
                                                this.usuariosTable = this.datos;
                                                 this.vistaTabla = true;
                                            }

                                        } else {
                                                                this.vistaBusqueda = true;
                                                                this.vistaOpcionesTabla = true;
                                                                this.vistaTabla = true;
                                                                this.vistaPaginacion = true;

                                            this.usuariosTable = this.datos.data;
                                            this.paginacion.total = this.datos.total;
                                            if (page == undefined) {
                                                this.paginacion.current_page = this.datos.current_page;
                                            }
                                            this.paginacion.per_page = this.datos.per_page;
                                            this.paginacion.last_page = this.datos.last_page;
                                            this.paginacion.from = this.datos.from;
                                            this.paginacion.to = this.datos.to;

                                        }
                            }).catch(error => {
                                console.log(error);
                                this.consultarNombreUsuario(page);
                        }); 
                    }


                },

                validar : function () {
                    var patt1 = /^[0-9]+$/; // nombres apellidos
                    var patt2 =  /^[a-zA-Z_.@]+$/; // nombres de usuario
                    var patt3 = /^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/; // nombres apellidos
                    var correo = /^\w+([\.\+\-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;
                   

    
                    if(this.usuario === ''){
                        this.errores.push("ingrese el nombre del usuario (Debe de ser unico)");
                    } else {
                        this.usuario= this.usuario.trim();
                        if(patt3.test(this.usuario) == false)
                        {
                            this.errores.push("El nombre de usuario no puede contener espaciones, numeros  o caracteres especiales distintots a: '_' ");
                        }else{
                            // consulta a la base de datos /seguridad/validar/usuario/bryan/nombre/update/1
                            axios.get('/seguridad/validar/usuario/'+this.usuario+'/nombre/store').then(response => {
                                this.respuesta1  = response.data;

                                if(this.respuesta1.length !== 0) {
                                    this.errores.push('El nombre de usuario ya se encuentra registrado');
                                }
                            })
                        }

                    }


                     if(this.email === ''){
                        this.errores.push("ingrese el email del usuario");
                    } else {
                        this.email= this.email.trim();
                        if(correo.test(this.email) == false)
                        {
                            this.errores.push("El correo electronico ingresado no es valido");
                        }else{
                            // consulta a la base de datos
                            axios.get('/seguridad/validar/usuario/'+this.email+'/email/store').then(response => {
                                this.respuesta2  = response.data;

                                if(this.respuesta2.length !== 0) {
                                    this.errores.push('El email del usuario ya se encuentra registrado');
                                }
                            })
                        }

                    }

                    if(this.pass === ''){
                        this.errores.push("ingrese la contraseña");
                    } else {
                        if(this.pass.length < 8){
                            this.errores.push("La contraseña debe tener un minimo de 8 caracteres");
                        }
                    }
                    if(this.pass2 === ''){
                        this.errores.push("ingrese la confirmación de la contraseña");
                    }

                    if(this.pass !== '' && this.pass2 !== '' )
                    {
                        if(this.pass !== this.pass2){
                            this.errores.push("las contraseñas no coinciden");
                        }
                    }

                    if(this.rol === ''){
                        this.errores.push("seleccione el rol del nuevo usuario");
                    }

                    if(this.respuesta1 === 0) {
                        this.errores.push("El nombre del usuario ya se encuentra registrado");
                    }

                    if(this.respuesta2 === 0) {
                        this.errores.push("La dirección ip se encuentra registrada");
                    }

                    if( this.errores.length === 0) {
                       this.crear();
                    } else {
                        var num = this.errores.length;
                        for(i=0; i<num;i++) {
                            toastr.error(this.errores[i]);
                        }
                    }
                    this.errores = [];
                },

                actualizar : function () {
                    var patt1 = /^[0-9]+$/; // nombres apellidos
                    var patt2 =  /^[a-zA-Z_.@]+$/; // nombres de usuario
                    var patt3 = /^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/; // nombres apellidos
                    var correo = /^\w+([\.\+\-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;


                    if(this.e_usuario === ''){
                        this.errores.push("ingrese el nombre del usuario (Debe de ser unico)");
                    } else {
                        if(patt2.test(this.e_usuario) == false)
                        {
                            this.errores.push("El nombre de usuario no puede contener espaciones, numeros  o caracteres especiales distintots a: '_' ");
                        }else{
                            // consulta a la base de datos /seguridad/validar/usuario/bryan/nombre/update/1
                            axios.get('/seguridad/validar/usuario/'+this.e_usuario+'/nombre/update/'+this.e_id).then(response => {
                                this.respuesta1_update  = response.data;

                                if(this.respuesta1_update.length !== 0) {
                                    this.errores.push('El nombre de usuario ya se encuentra registrado');
                                }
                            })
                        }
                    }

                     if(this.e_email === ''){
                        this.errores.push("ingrese el email del usuario");
                    } else {
                        this.e_email= this.e_email.trim();
                        if(correo.test(this.e_email) == false)
                        {
                            this.errores.push("El correo electronico ingresado no es valido");
                        }else{
                            // consulta a la base de datos
                            axios.get('/seguridad/validar/usuario/'+this.e_email+'/email/update/'+this.e_id).then(response => {
                                this.respuesta2_update  = response.data;

                                if(this.respuesta2_update.length !== 0) {
                                    this.errores.push('El email del usuario ya se encuentra registrado');
                                }
                            })
                        }

                    }

                    if(this.e_pass !== '' && this.e_pass2 !== '' )
                    {
                        if(this.e_pass !== this.e_pass2){
                            this.errores.push("las contraseñas no coinciden");
                        }
                        if(this.e_pass.length < 8){
                            this.errores.push("La contraseña debe tener un minimo de 8 caracteres");
                        }
                    }

                    if(this.e_roles === ''){
                        this.errores.push("seleccione el rol del nuevo usuario");
                    }

                    if( this.errores.length === 0) {
                        var url = 'usuarios/update'
                         axios.put(url, {
                            id :   this.e_id  ,
                            name :   this.e_usuario.toLowerCase() , 
                            email : this.e_email ,
                             promocion : this.e_promocion,
                            rol : this.e_roles, 
                                }).then(response => {
                                    if(response.data[0] == "Error") {
                                        if(response.data[1] == 1062) {
                                            toastr.error("El nombre se encuentra duplicado");
                                        } else {
                                            toastr.error("Error al guardar el rol");
                                        }
                                    }else {
                                        $("#editarUsuarios").modal('hide');
                                        toastr.success("Usuario actualizado con exito");
                                        this.limpiar();
                                        this.loadUsuarios();
                                    }
                                }).catch(response=> {
                                    console.log(response);
                                    if(response.status === 422)
                                    {
                                        var errors = $.parseJSON(response.responseText);
                                        $.each(errors, function (key, value) {
                                            if($.isPlainObject(value)) {
                                                $.each(value, function (key, value) {
                                                    toastr.error('Error en el controlador: '+value+'', 'Error', {timeOut: 5000});
                                                    console.log(key+ " " +value);
                                                });
                                            }else{
                                                toastr.error('Error '+response+' al momento de crear el rol.', 'Error', {timeOut: 5000});
                                            }
                                        });
                                    }
                        });
                        
                    } else {
                        var num = this.errores.length;
                        for(i=0; i<num;i++) {
                            toastr.error(this.errores[i]);
                        }
                    }
                    this.errores = [];
                },

                suprimir : function (id) {

                    swal({
                        title: "Eliminar!",
                        text: "Esta seguro que desea eliminar este registro",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                        .then((willDelete) => {
                        if (willDelete) {
                            var url = '/seguridad/usuarios/delete/'+id;
                            axios.get(url, {
                            }).then(response => {

                                if(response.data[0] == "Error") {
                                    toastr.error("Error al eliminar el usuario");
                                }else {

                                this.loadUsuarios();
                                }
                        }).catch(error => {
                                console.log(error);
                                toastr.error("al momento de eliminar el usuario ")
                        });
                            swal("Eliminado! El usuario se ha sido eliminada!", {
                                icon: "success",
                            });
                        } else {
                            swal("Su información se encuentra seguro!");
                }
                });
                },



            }

        });


    </script>

   
@endsection

   