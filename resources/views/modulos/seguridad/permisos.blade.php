@extends('layouts.administracion')
@section('nombre_pagina','Permisos')
@section('css')

@endsection
@section('titulo de la pagina','Permisos')
{{-- @section('breadcrumbs')
    {{ Breadcrumbs::render('permisos') }}
@endsection --}}
@section('contenido')

<div class="col-md-12" id="permisos" v-cloak>
        <div class="tile">
            
            <div class="col-md-12">
                <button class="btn btn-primary btn-lg pull-right" data-toggle="modal" data-target="#crearPermiso"> Crear </button>
               <div>
                   <input  type="text"  class="col-md-4 form-control " placeholder="Buscar permiso por nombre" name="name" v-model="permiso" v-on:keyup.13="consultarNombrePermisos">
               </div>
            </div>
            <br>
            <div>
                    <div class="form-inline">
                         <div class="form-group col-md-1.5 mb-2" style="margin-left:60px" v-if="paginacion.total > 5" >
                            <label> Mostrar : </label>
                            <select v-on:change="changeNumberPage" v-if="paginacion.total > 5" v-model="datosPorPagina" class="form-control">
                               <option  v-for="cantidad in cantidadPorPagina">   @{{cantidad}}   </option>
                            </select>
                        </div>
                        <div v-if="datosNumber !== 0" class="form-group col-md-2.5 mb-2" style="margin-left:510px" >
                            <label> Ordenar : </label>
                            <select v-on:change="ordenar" v-model="orden" class="form-control">
                                <option value="asc">Ascendente</option>
                                <option value="desc">Descendente</option>
                            </select>
                        </div>
                    </div>
           
            <hr>
            <div class="col-sm-12 col-sm-offset-2" style="background-color:white;">
                <table class="table table-hover table-bordered"  v-if="datosNumber !== 0">
                    <thead>
                    <tr>
                        <th>Nombres</th>
                       
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr v-for="dato in permisosTable">
                            <td>@{{dato.name}}</td>
                           
                            <td>@{{dato.description}}</td>
                            <td>
                                    <button type="button" class="btn btn-info" v-on:click="ver(dato.id)">Ver</button>
                                    <button type="button" class="btn btn-success" v-on:click="editar(dato.id)">Editar</button>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Nombres</th>
                       
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                    </tfoot>
                </table>
                <div v-else>
                    <div class="alert alert-danger">
                        <p> NO existen <strong>permisos</strong> registrados</p>
                    </div>
                </div>
            </div>
            <div class="form-inline" v-if="datosNumber !== 0">
                <div class="col-md-4">
                    <span> @{{ paginacion.to }} de @{{paginacion.total}} registros</span>
                </div>

                <div class="col-md-8">

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
        <!-- modales -->
        <div id="crearPermiso" class="modal fade" role="dialog" >
            <div class="modal-dialog modal-lg">
                <div class="col-lg-12">
                    <div class="bs-component">
                        <div class="modal" style="position: relative; top: auto; right: auto; left: auto; bottom: auto; z-index: 1; display: block;">
                          <form id="frmGuardar" name="frmGuardar" method="post" action="">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Creacion de permisos</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    </div>
                                    <div class="modal-body">
                                    
                                        <div class="form-group">
                                            <input type="text" class="form-control" v-model="name" id="nombre" required name="nombre"   placeholder="nombre del permmiso" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" required class="form-control" v-model="slug" id="slug" name="slug"  placeholder="nombre de la ruta" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" required class="form-control" v-model="description" id="descripcion"  name="descripcion" placeholder="descripcion del permiso" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary" id="guardar" type="button" v-on:click="crear">Guardar</button>
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
        <div id="vistaPermisos" class="modal fade" role="dialog" >
            <div class="modal-dialog modal-lg">
                <div class="col-lg-12">
                    <div class="bs-component">
                        <div class="modal" style="position: relative; top: auto; right: auto; left: auto; bottom: auto; z-index: 1; display: block;">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Permisos</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    </div>
                                    <div class="modal-body">
                                         <div class="form-group">
                                            <input type="text" class="form-control" readonly id="nombre" name="nombre" v-model="v_nombre"   placeholder="nombre del permmiso" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" readonly v-model="v_slug" id="slug" name="slug"  placeholder="nombre de la ruta" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="descripcion" readonly v-model="v_descripcion"  name="descripcion" placeholder="descripcion del permiso" autocomplete="off">
                                        </div>
                                        <label class="label-text"> Fecha creacion:</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" readonly v-model="v_fechac" id="v_fechaoc" placeholder="Nombres" autocomplete="off">
                                        </div>
                                        <label class="label-text"> Fecha modificacion:</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" readonly v-model="v_fecham" id="v_fecham" placeholder="Nombres" autocomplete="off">
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
        <div id="editarPermisos" class="modal fade" role="dialog" >
            <div class="modal-dialog modal-lg">
                <div class="col-lg-12">
                    <div class="bs-component">
                        <div class="modal" style="position: relative; top: auto; right: auto; left: auto; bottom: auto; z-index: 1; display: block;">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Actualizar permisos</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <label class="label-text"> Nombre:</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" v-model="e_nombre" id="e_nombre"  placeholder="Nombre del permiso" autocomplete="off">
                                        </div>
                                        <label class="label-text"> Slug:</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" v-model="e_slug" id="e_slug" placeholder="" autocomplete="off">
                                        </div>
                                        <label class="label-text"> Descripción:</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" v-model="e_descripcion" id="e_descripcion" placeholder="Descripcion del permiso" autocomplete="off">
                                        </div>
                                        <input type="hidden" id="respuesta_guardado">
                                        <input type="hidden" id="respuesta_actualizacion">
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary" type="button" v-on:click="actualizar()">Actualizar</button>
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

        var app=new Vue({
    el: '#permisos',
    data : {
                permisosTable : [], /* contenido de la tabla principal */   

                /* variables para guardar permiso */
                name : '',
                slug :'',
                description : '',

                /* variables de la aplicacion */
                errores : [],
                mensaje : 'el permiso',
                mensaje2 : 'Permiso',
                respuesta : 0,
 
                permisos_s : [],
                permisos_e : [],

               

                id_edicion : 0,
                // modelos
        
        
                //visualizar
                v_id  : '',
                v_nombre : '',
                v_slug : '',
                v_descripcion : '',
                v_usuarioc : '',
                v_usuariom : '',
                v_fechac : '',
                v_fecham :'',
                //editar

                e_id  : '',
                e_nombre : '',
                e_slug : '',
                e_usuario : '',
               e_descripcion : '',
                e_usuarioc : '',
                e_usuariom : '',
                e_fechac : '',
                e_fecham :'',

                consulta : '',

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
                datos :[],

                /* busqueda */
                permiso : '',

                /* orden de la tabla */
                orden :'asc',
                datosPagina : [],
                datosPorPagina : 5,


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

                    return this.permisosTable.length;
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

    created : function() {
        toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": false,
  "progressBar": false,
  "positionClass": "toast-top-right",
  "preventDuplicates": true,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
        /* TODO  toastr*/
        this.loadPermisos();
        //this.cantidadPorPagina2;
    },

    methods : {

                prueba : function (){
                    toastr.success("muestra el mensaaje");
                },

                 cantidadPorPagina2 : function () {
                   var total = this.paginacion.total;
                   var inicial = 0;

                   while(true) {
                        var inicial = inicial + 5;
                        if(this.paginacion.total <= inicial) {
                            return this.datosPagina;
                           break;
                       } else {
                         this.datosPagina.push(inicial)
                       }
                   }             
                },
                //---------------------------- CRUD -----------------------------------------//

                // guardar un nuevo permiso 

                crear : function () {
                    this.validar('crear');
                    if( this.errores.length === 0) {
                        this.insertarPermiso();
                    } else {
                        var num = this.errores.length;
                        for(i=0; i<num;i++) {
                            toastr.error(this.errores[i]);
                        }
                    }
                    this.errores = [];
                },

                 
                insertarPermiso : function() {
                    $url = '/seguridad/permisos/store';
                        axios.post($url, {
                                slug : this.slug.toLowerCase(),
                                name : this.name.toLowerCase(),
                                description : this.description.toLowerCase(),
                        
                            }).then(response => {
                                if(response.data[0] == "Error") {
                                    if(response.data[1] == 1062) {
                                        toastr.error("El nombre se encuentra duplicado");
                                    } else {
                                        toastr.error("Error al guardar "+this.mensaje);
                                    }
                                } else {
                                     $("#crearPermiso").modal('hide');
                                    toastr.success('Permiso creado con exito.', 'Exito', {timeOut: 5000});
                                    this.limpiar();
                                    this.loadPermisos();
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
                  /* ver info de un permiso */  
                 ver :function (id) {
                    
                    var url = '/seguridad/show/permisos/'+id+'';
                    axios.get(url).then(response => {
                        this.permisos_s  = response.data;
                    this.v_id = this.permisos_s[0].id;
                    this.v_slug = this.permisos_s[0].slug;
                    this.v_nombre = this.permisos_s[0].name;
                    this.v_descripcion = this.permisos_s[0].description;
                    this.v_fechac = this.permisos_s[0].created_at;
                    this.v_fecham = this.permisos_s[0].updated_at;
                    });
                    $("#vistaPermisos").modal('show');
                },
                /* Editar la info de un permiso */
                editar :function (id) {
                
                    var url = '/seguridad/show/permisos/'+id+'';
                    axios.get(url).then(response => {
                        this.permisos_e  = response.data;
                        this.e_id = this.permisos_e[0].id;
                        this.e_slug = this.permisos_e[0].slug;
                        this.e_nombre = this.permisos_e[0].name;
                        this.e_descripcion = this.permisos_e[0].description;
                   
                    });

                    $("#editarPermisos").modal('show');
                },

                /* acctulizar permisos */
                  actualizar : function () {
                    this.validar("actualizar");
                    
                    if( this.errores.length === 0) {

                        url = '/seguridad/permisos/update'
                        axios.put(url, {
                            id :   this.e_id  ,
                            slug :   this.e_slug.toLowerCase() ,
                            name :   this.e_nombre.toLowerCase() , 
                            description :   this.e_descripcion.toLowerCase() , 
                                }).then(response => {
                                    if(response.data[0] == "Error") {
                                        if(response.data[1] == 1062) {
                                            toastr.error("El nombre se encuentra duplicado");
                                        } else {
                                            toastr.error("Error al guardar el permiso");
                                        }
                                    }else {
                                       
                                        toastr.success(this.mensaje2+" actualizado con exito");
                                        this.limpiar();
                                        this.loadPermisos();
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
                                                toastr.error('Error '+response+' al momento de crear el permiso.', 'Error', {timeOut: 5000});
                                            }
                                        });
                                    }
                        });

                    }else {
                        var num = this.errores.length;
                        for(i=0; i<num;i++) {
                            toastr.error(this.errores[i]);
                        }
                        this.errores = []
                    } 

                },

                /* eliminar permisos */
                
                deleted :function(id) {
                    var estado = 0;


                        var ciclo = 0;
                     while(ciclo === 0)
                     {
                         swal({
                             title: "Are you sure?",
                             text: "You will not be able to recover this imaginary file!",
                             type: "warning",
                             showCancelButton: true,
                             confirmButtonText: "Yes, delete it!",
                             cancelButtonText: "No, cancel plx!",
                             closeOnConfirm: false,
                             closeOnCancel: false
                         }, function(isConfirm) {

                             if (isConfirm) {
                                 /*
                                         var parametros = {
                                             "_token": " {/{ csrf_token() }}",
                                             "id" : id
                                         };
                                         $.ajax({
                                             data : parametros,
                                             url : "permisos/"+id+"/delete",
                                             type : "post",
                                             async:false,
                                             success : function(response){
                                                 console.log("exito");
                                                 estado = 1;
                                             },
                                             error : function (response,jqXHR) {
                                                 console.log(response);
                                                 toastr.error('Error al momento de crear el permiso.', 'Alerta', {timeOut: 8000});
                                             }
                                         }); */
                                 swal("Deleted!", "Your imaginary file has been deleted.", "success");
                                 estado = 1;


                             } else {
                                 swal("Cancelled", "Your imaginary file is safe :)", "error");
                             }
                         });
                        if (estado === 1) {
                            console.log(estado);
                            ciclo = 1;
                           break;
                        }
                    }
                        /*
                            var parametros = {
                                "_token": " //{ csrf_token() }}",
                                "id" : id
                            };
                            $.ajax({
                                data : parametros,
                                url : "permisos/"+id+"/delete",
                                type : "post",
                                async:false,
                                success : function(response){
                                    console.log("exito");
                                },
                                error : function (response,jqXHR) {
                                    console.log(response);
                                }
                            });
                               */



                }, // TODO

                suprimir : function (id) {

                    var parametros = {
                        "_token": " {{ csrf_token() }}",
                        "id" : id
                    };
                    $.ajax({
                        data : parametros,
                        url : "permisos/"+id+"/delete",
                        type : "post",
                        async:false,
                        success : function(response){
                            toastr.success('Registro eliminado con exito.', 'Alerta', {timeOut: 8000});
                        },
                        error : function (response,jqXHR) {
                            console.log(response);
                            toastr.error('Error al momento de crear el permiso.', 'Alerta', {timeOut: 8000});
                        }
                    });
                    this.loadPermisos();

                }, //TODO

                //--------------------------  /CRUD ----------------------------------------//

                //-------------------------  VALIDAR --------------------------------------//

                     // valida la actualización y creación
                validar : function ($tipo) {
                    var datos_sin_numeros =  /^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/;
                    var patt2 =  /^[a-zA-Z.]+$/; // para la afinidad
                    var patt3 = /^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/; //para la observación
                      console.log($tipo);
                    if($tipo == 'crear') {
                        console.log("1");
                        
                        if(this.name === ''){
                            this.errores.push("Introduzca el nombre del nuevo permiso");
                        } else{
                            this.name = this.name.trim();
                            if(patt3.test(this.name) == false)
                            {
                                this.errores.push("EL nombre no puede contener numeros ni caracetes especiales");
                            }
                        }
                        if(this.slug === ''){
                            this.errores.push("Introduzca el slug del nuevo permiso");
                        }else {
                            this.slug= this.slug.trim();
                            if(patt2.test(this.slug) == false)
                            {
                                this.errores.push("EL slug  no puede contener espacios,numeros ni caracetes especiales distitos a '.'");
                            }
                        }
                        if(this.description === ''){
                            this.errores.push("Introduzca la descripcion del nuevo permiso");
                        }else{
                            this.description= this.description.trim();
                            if(patt3.test(this.description ) == false)
                            {
                                this.errores.push("La descripción no puede contener numeros ni caracetes especiales");
                            }
                        } 
                    }else if($tipo == "actualizar") {
                        console.log("2");
                        
                        if(this.e_nombre === ''){
                            this.errores.push("Introduzca el nombre del permiso");
                        } else{
                            this.e_nombre= this.e_nombre.trim();
                            if(patt3.test(this.e_nombre) == false)
                            {
                                this.errores.push("EL nombre no puede contener numeros ni caracetes especiales");
                            }
                        }
                        if(this.e_slug === ''){
                            this.errores.push("Introduzca el slug del permiso");
                        }else{
                            this.e_slug= this.e_slug.trim();
                            if(patt2.test(this.e_slug) == false)
                            {
                                this.errores.push("EL slug  no puede contener espacios,numeros ni caracetes especiales distitos a '.'");
                            }
                        }
                        if(this.e_descripcion === ''){
                            this.errores.push("Introduzca la descripcion del  permiso");
                        }else{
                            this.e_descripcion= this.e_descripcion.trim();
                            if(patt3.test(this.e_descripcion ) == false)
                            {
                                this.errores.push("La descripción no puede contener numeros ni caracetes especiales");
                            }
                        } 
                    } else if($tipo == "busqueda") {

                            console.log("3");
                            if (this.permiso == ''){
                                return true;
                            } else if(datos_sin_numeros.test(this.permiso) == false){
                                toastr.error("EL nombre no puede contener numeros ni caracetes especiales");
                                return false;
                            }                              
                            this.permiso = this.permiso.trim();
                            return true;
                    }

                },      

                //-------------------------  /VALIDAR --------------------------------------//    

                //----------------------- CONSULTAS ---------------------------------------//
                    // recarga la tabla

                consultarNombrePermisos : function(page) {

                    var respuesta = this.validar('busqueda');

                    if( respuesta !== false) {
                            console.log('exito');
                            var url = page !== undefined ?  '/seguridad/permisos/datos/'+this.datosPorPagina+'/'+0+'/'+this.permiso : '/seguridad/permisos/datos/'+this.datosPorPagina+'/'+page+'/'+this.permiso;
                            axios.get(url).then(response => {
                                    this.datos = response.data;
                                    this.permisosTable = this.datos.data
                                    this.paginacion.total = this.datos.total;
                                    if(page == undefined) {
                                        this.paginacion.current_page = this.datos.current_page;
                                    }
                                    this.paginacion.per_page = this.datos.per_page;
                                    this.paginacion.last_page = this.datos.last_page;
                                    this.paginacion.from = this.datos.from;
                                    this.paginacion.to = this.datos.to;
                                }).catch(error => {
                                    console.log(error);
                                    this.consultarNombrePermisos(page);
                            });
                    }


                },
                recargar : function () {
                    var url = '/seguridad/permisos/datos' //page !== undefined ?  '/administrador/marca/load/'+page : '/administrador/marca/load';
                    axios.get(url).then(response => {
                        this.permisosTable = response.data;
                        /*
                            this.datos = response.data;
                            this.cmbMarcas = this.datos.data
                            this.paginacion.total = this.datos.total;
                                if(page == undefined) {
                                    this.paginacion.current_page = this.datos.current_page;
                                }
                            this.paginacion.per_page = this.datos.per_page;
                            this.paginacion.last_page = this.datos.last_page;
                            this.paginacion.from = this.datos.from;
                            this.paginacion.to = this.datos.to; */
                        }).catch(error => {
                            console.log(error);
                             this.recargar();
                    });    
                },

                //----------------------- /CONSULTAS ---------------------------------------//
                    
                //----------------------  FUNCIONES --------------------------------------//
                     limpiar : function() {
                    this.name = '';
                    this.slug = '';
                    this.description = '';
                    this.e_name = '';
                    this.e_slug ='';
                    this.e_description = '';
                    
                },

                    ordenar : function() {
                        if(this.orden == 'asc' ) {
                            this.permisosTable.sort(function (a, b) {
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
                            this.permisosTable.sort(function (a, b) {
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
                //----------------------  /FUNCIONES --------------------------------------//

                //--------------------- PAGINACION ---------------------------------------//
                loadPermisos : function(page) {

                    var url = page !== undefined ?  '/seguridad/permisos/datos/'+this.datosPorPagina+'/'+page : '/seguridad/permisos/datos/'+this.datosPorPagina;
                    axios.get(url).then(response => {

                    this.datos = response.data;
                    this.permisosTable = this.datos.data

                    this.paginacion.total = this.datos.total;
                    if(page == undefined) {
                        this.paginacion.current_page = this.datos.current_page;
                    }
                    this.paginacion.per_page = this.datos.per_page;
                    this.paginacion.last_page = this.datos.last_page;
                    this.paginacion.from = this.datos.from;
                    this.paginacion.to = this.datos.to;
                }).catch(error => {
                        console.log(error);
                    this.loadPermisos();
                });
                },

                 changePage: function(page) {
                    this.paginacion.current_page = page;
                    this.permiso === '' ? this.loadPermisos(page) : this.consultarNombrePermisos(page);
                },

                changeNumberPage :function(page) {
                    this.permiso === '' ? this.loadPermisos(page) : this.consultarNombrePermisos(page);                    
                }

                
                //--------------------- PAGINACION ---------------------------------------//
                
                
               
    }
  })    
    </script>

@endsection