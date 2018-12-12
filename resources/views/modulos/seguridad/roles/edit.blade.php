@extends('layouts.administracion')
@section('nombre_pagina','Edicion de roles')
@section('css')
    <style>
      
    </style>
@endsection
@section('titulo de la pagina')
    <p><a href="{{route('seguridad.roles.index')}}">Roles</a>/Edición</p>
@endsection
{{-- @section('breadcrumbs')
    {{ Breadcrumbs::render('roles-edit',$resultado[0]->name) }}
@endsection --}}
@section('contenido')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @include('flash::message')
    <div class="col-md-12" id="roles_edit">

        <div class="tile">
                <div class="col-md-12">
                    @foreach($resultado as $datos)
                    <form method="post" action="{{route('seguridad.roles.update',['id'=>$datos->id])}}" id="frmUpdate">
                        {{csrf_field()}}
                    <input type="hidden" value="{{$datos->id}}" id="id">
                    <label class="label-text"> Nombre:</label>
                    <div class="form-group">
                        <input type="text"  value="{{$datos->name}}" class="form-control " name="name" id="v_nombre"  placeholder="Nombre del rol" autocomplete="off" v-on:keyup="validarNombreRol">
                    </div>
                    <label class="label-text"> Slug:</label>
                    <div class="form-group">
                        <input type="text"  value="{{$datos->slug}}" class="form-control" name="slug"  id="v_slug" placeholder="Nombre del slug usado" autocomplete="off" v-on:keyup="validarSlugRol">
                    </div>
                    <label class="label-text"> Description:</label>
                    <div class="form-group">
                        <input type="text"   value="{{$datos->description}}" class="form-control" name="description"  id="v_descripcion" placeholder="Descripción del rol" autocomplete="off">
                    </div>

                    <label>Permisos especiales</label>
                    <select class="form-control" name="especial" required>
                        <option value="all-access" @if($datos->special == "all-access") selected  @endif > Acceso total</option>
                        <option value="no-access" @if($datos->special == "no-access") selected   @endif> Sin  acceso</option>
                        <option value="null" @if($datos->special ==  null) selected   @endif> Acceso restringido</option>
                    </select>
                @endforeach
                <h3>permisos actuales</h3>

                <ul>
                    @foreach($permisos as $datos)
                        <label><input type='checkbox' name='actuales[]' checked value= {{$datos->id}}> {{$datos->name}} </label><br>
                    @endforeach
                </ul>
                <h3>permisos faltantes</h3>
                <ul>
                    @foreach($permisosF as $datos)
                        <label><input type='checkbox' name='nuevos[]' value= {{$datos->id}}> {{$datos->name}} </label><br>
                    @endforeach
                </ul>
                    <hr>
                    <button class="btn btn-primary" type="button" @click="validar">Guardar</button>
            </form>
                </div>
        </div>
    </div>
@endsection
@section('js')

    <script>
        var app = new Vue ({
            el:'#roles_edit',
            data : {
                rol : '',
                slug : '',
                descripcion : '',
                permiso_especial : '',
                errores : [],
            },
            created : function() {

            },

            methods : {

                validarNombreRol : function () {
                    this.id = $("#id").val();
                    this.rol = $("#v_nombre").val();
                    axios.get('/seguridad/validar/update/rol/'+this.rol+'/'+this.id+'/name').then(response => {
                        this.respuesta1  = response.data;
                })
                },
                validarSlugRol : function () {
                    this.id = $("#id").val();
                    this.slug = $("#v_slug").val();
                    axios.get('/seguridad/validar/update/rol/'+this.slug+'/'+this.id+'/slug').then(response => {
                        this.respuesta2  = response.data;
                    })
                },

                validar : function () {
                    var patt2 =  /^[a-zA-Z.]+$/; // para la afinidad
                    var patt3 = /^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/; //para la observación
                    this.rol = $("#v_nombre").val();
                    this.slug = $("#v_slug").val();
                    this.descripcion = $("#v_descripcion").val();
                    this.id = $("#id").val();

                    if(this.rol === ''){
                        this.errores.push("Introduzca la información del rol");
                    } else{
                        this.rol = this.rol.trim();
                        if(patt3.test(this.rol) == false)
                        {
                            this.errores.push("EL campo rol no puede contener numeros ni caracetes especiales");
                        }else {

                        }
                    }
                    if(this.slug === ''){
                        this.errores.push("Introduzca la información del slug");
                    }else {
                        this.slug= this.slug.trim();
                        if(patt2.test(this.slug) == false)
                        {
                            this.errores.push("EL slug  no puede contener espacios,numeros ni caracetes especiales distitos a '.'");
                        }else {

                        }
                    }
                    if(this.descripcion === ''){
                        this.errores.push("Introduzca la información del campo  descripción");
                    }else{
                        this.descripcion= this.descripcion.trim();
                        if(patt3.test(this.descripcion) == false)
                        {
                            this.errores.push("La descripción no puede contener numeros ni caracetes especiales");
                        }
                    }

                    if(this.respuesta1 === 0) {
                        this.errores.push("El nombre del Rol ya se encuentra registrado");
                    }

                    if(this.respuesta2 === 0) {
                        this.errores.push("El slug del rol ya se encuentra registrado");
                    }
                    if( this.errores.length === 0) {
                        document.getElementById('frmUpdate').submit();
                    } else {
                        var num = this.errores.length;
                        for(i=0; i<num;i++) {
                            toastr.error(this.errores[i]);
                        }
                    }
                    this.errores = [];


                },

            }

        });


    </script>

    <!-- <script type="text/javascript">
        $(document).ready(function() {
            $.get("permisostables", function (datos) {
                $.each(datos, function (key, value) {
                    $("#lista_permisos").append("<label><input type='checkbox' name='permisos[]' value= " + value.id + ">"+value.description +"</label><br>");
                });
            });
        });
    </script> -->
@endsection