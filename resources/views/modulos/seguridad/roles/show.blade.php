@extends('layouts.administracion')
@section('nombre_pagina','Rol')
@section('css')
@endsection
@section('titulo de la pagina')
    <p><a href="{{route('seguridad.roles.index')}}">Roles</a>/Vista</p>
@endsection
{{-- @section('breadcrumbs')
    {{ Breadcrumbs::render('roles-show',$resultado[0]->name) }}
@endsection --}}
@section('contenido')
    <div class="col-md-12" id="">
        <div class="tile">
            <div class="col-md-12">
                  @foreach($resultado as $datos)
                    <label class="label-text"> Nombre:</label>
                    <div class="form-group">
                        <input type="text" readonly value="{{$datos->name}}" class="form-control" name="name" v-model="v_nombre" id="v_nombre"  placeholder="Nombre del rol" autocomplete="off">
                    </div>
                    <label class="label-text"> Slug:</label>
                    <div class="form-group">
                        <input type="text" readonly value="{{$datos->slug}}"class="form-control" name="slug" v-model="v_slug" id="v_slug" placeholder="Nombre del rol" autocomplete="off">
                    </div>
                    <label class="label-text"> Description:</label>
                    <div class="form-group">
                        <input type="text" readonly value="{{$datos->description}}" class="form-control" name="description" v-model="v_descripcion" id="v_descripcion" placeholder="Descripción del rol" autocomplete="off">
                    </div>

                    <label>Permisos especiales</label>
                     @if($datos->special == 'all-accces')
                        <input class="form-control" type="text" readonly name="special" value="Acceso total"><br>
                    @else
                        <input class="form-control" type="text" readonly name="special" value="Acceso restringido"><br>
                    @endif
                    <label>Fecha de creación</label>
                    <input class="form-control" type="text" readonly name="creacion" value="{{$datos->created_at}}"><br>
                    <label>Fecha de modificación</label>
                    <input class="form-control" type="text" readonly name="actualizacion" value="{{$datos->updated_at}}"><br>

                    @endforeach
                    <h4>permisos individuales</h4>
                    <ul>
                        @forelse($permisos as $datos)
                        <li>
                            {{$datos->name}}
                        </li>
                        @empty
                            <div class="alert alert-danger" role="alert" v-if="mensaje_registro === true">
                                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                <span class="sr-only">Error:</span>
                               Este rol no cuenta con permisos individuales
                            </div>
                        @endforelse
                    </ul>
            </div>
        </div>
    </div>
@endsection
@section('js')

    <script>
        var app = new Vue ({
            el:'#roles',
            data : {
                permisos : [],
                permisos_rol : [],
                roles : [],
                roles_s : [],
                roles_e : [],

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
                v_special : '',
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
                e_special : ''

            },
            created : function() {
                axios.get('rolestables').then(response => {
                    this.roles  = response.data
            })

                axios.get('permisostables').then(response => {
                    this.permisos  = response.data
            })

            },

            methods : {

                // recarga la tabla
                recargar : function () {
                    axios.get('rolestables').then(response => {
                        this.roles  = response.data
                })

                    axios.get('permisostables').then(response => {
                        this.permisos  = response.data
                })
                },

                table : function () {
                    axios.get('rolestables').then(response => {
                        this.roles  = response.data
                })
                }, // eliminar si no se utiliza

                crear : function () {


                    var parametros = {
                        "_token": "{{ csrf_token() }}",
                        "slug" : $("#slug").val(),
                        "name" : $("#nombre").val(),
                        "description" : $("#descripcion").val(),
                        "permisos" : $("#descripcion").val()
                    };
                    $.ajax({
                        data : parametros,
                        url : "rolesstore",
                        type : "post",
                        success : function(response){
                            //response contiene la respuesta al llamado de tu archivo
                            //aqui actualizas los valores de inmediato llamando a sus respectivas id.

                            $("#crearRoles").modal('hide');
                            $('input[type="text"]').val('');
                            toastr.success('Rol creado con exito.', 'Success Alert', {timeOut: 5000});
                        },
                        error : function (response,jqXHR) {
                            toastr.error('Error al momento de crear el rol.', 'Success Alert', {timeOut: 5000});
                            // var errors = $.parseJSON(response.responseText);
                            // $.each(errors, function (key, value) {
                            //     console.log(value);
                            // });

                        }
                    });
                    this.table();
                }, // sin uso

                ver :function (id) {
                    this.v_id = id;

                    var show = 'rolesshow/'+id+'';
                    axios.get(show).then(response => {
                        this.roles_s  = response.data;
                    this.v_id = this.roles_s[0].id;
                    this.v_slug = this.roles_s[0].slug;
                    this.v_nombre = this.roles_s[0].name;
                    this.v_descripcion = this.roles_s[0].description;
                    this.v_fechac = this.roles_s[0].created_at;
                    this.v_fecham = this.roles_s[0].updated_at;
                    this.v_special = this.roles_s[0].special;
                })
                    var permiso = 'rolespermisos/'+id+'';
                    axios.get(permiso).then(response => {
                        this.permisos_rol= response.data;

                })

                    $("#vistaRoles").modal('show');

                },

                editar :function (id) {
                    this.id_edicion = id;

                    var show = 'rolesedit/'+id+'';
                    axios.get(show).then(response => {
                        this.roles_e  = response.data;
                    this.e_id = this.roles_e[0].id;
                    this.e_slug = this.roles_e[0].slug;
                    this.e_nombre = this.roles_e[0].name;
                    this.e_descripcion = this.roles_e[0].description;
                    this.e_fechac = this.roles_e[0].created_at;
                    this.e_fecham = this.roles_e[0].updated_at;
                    this.e_special = this.roles_e[0].special;
                });

                    $("#editarRoles").modal('show');
                },

                actualizar : function (id) {

                    var parametros = {
                        "_token": "{{ csrf_token() }}",
                        "slug" : $("#e_slug").val(),
                        "name" : $("#e_nombre").val(),
                        "description" : $("#e_descripcion").val(),
                        "special" : $("select[name=e_special]").val()
                    };
                    $.ajax({
                        data : parametros,
                        url : "/roles/"+this.id_edicion+"/update",
                        type : "post",
                        async : false,
                        success : function(response){
                            //response contiene la respuesta al llamado de tu archivo
                            //aqui actualizas los valores de inmediato llamando a sus respectivas id.
                            console.log("exito");
                            $("#editarRoles").modal('hide');
                            $('input[type="text"]').val('');
                            toastr.success('Rol actualizado con exito.', 'Exito', {timeOut: 5000});
                        },
                        error : function (response,jqXHR) {
                            toastr.error('Error al momento de actualizar el rol.', 'Error', {timeOut: 5000});
                            // var errors = $.parseJSON(response.responseText);
                            // $.each(errors, function (key, value) {
                            //     console.log(value);
                            // });

                        }
                    })
                    this.recargar();

                },

                suprimir : function (id) {

                    toastr.warning('Antes de eliminar debe actualizar a los usuarios con este rol.', 'Advertencia', {timeOut: 5000});
                    // mostrar una lista de usuarios con este rol.
                    // desea actualizar a un rol Generico

                }

            }

        });


    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $.get("permisostables", function (datos) {
                $.each(datos, function (key, value) {
                    $("#lista_permisos").append("<label><input type='checkbox' name='permisos[]' value= " + value.id + ">"+value.description +"</label><br>");
                });
            });
        });
    </script>
@endsection