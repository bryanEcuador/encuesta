@extends('layouts.administracion')
@section('nombre_pagina','Crear rol')
@section('titulo de la pagina')
    <p><a href="{{route('seguridad.roles.index')}}">Roles</a>/Creación</p>
@endsection
@section('title','Roles')

@section('contenido')
    <div class="col-md-12" id="">
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
        <div class="tile">
            <div class="col-md-12" id="roles_create">
                <form id="frmGuardar" name="frmGuardar" method="post" action="{{route('seguridad.roles.store')}}">
                    {{ csrf_field() }}
                                <label class="label-text"> Nombre:</label>
                                <div class="form-group">
                                    <input type="text" v-model="rol"  class="form-control" name="name" v-model="v_nombre" id="v_nombre"  placeholder="Nombre del rol" autocomplete="off">
                                </div>
                                <label class="label-text"> Slug:</label>
                                <div class="form-group">
                                    <input type="text" v-model="slug" required class="form-control" name="slug" v-model="v_slug" id="v_slug" placeholder="Nombre del rol" autocomplete="off">
                                </div>
                                <label class="label-text"> Description:</label>
                                <div class="form-group">
                                    <input type="text" required v-model="descripcion" class="form-control" name="description" v-model="v_descripcion" id="v_descripcion" placeholder="Descripción del rol" autocomplete="off">
                                </div>

                                <h4>Permisos especiales</h4>
                                <label><input type="radio" required name="special" value="all-access"> Acceso total</label>
                                <label><input type="radio" name="special" value="no-access"> Sin acceso</label>
                                <label><input type="radio" name="special" value="neutro">Acceso restringido</label>
                                <h4>permisos individuales</h4>
                                <ul>
                                    <li id="lista_permisos" class="list-unstyled">
                                    </li>
                                </ul>
                                <button class="btn btn-primary" type="button" @click="validar" >Guardar</button> <!-- v-on:click="crear" -->
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')

    <script>
        var app = new Vue ({
            el:'#roles_create',
            data : {
               rol : '',
               slug : '',
               descripcion : '',
               permiso_especial : '',
               errores : [],
                respuesta1 : '',
                respuesta2 : ''
            },
            created : function() {
                    /* TODO */ 
                    /* toastr */
            },

            methods : {

                validar : function () {
                    var patt2 =  /^[a-zA-Z.]+$/; // para la afinidad
                    var patt3 = /^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/; //para la observación


                        if(this.rol === ''){
                            this.errores.push("Introduzca el nuevo rol");
                        } else{
                            this.rol = this.rol.trim();
                            if(patt3.test(this.rol) == false)
                            {
                                this.errores.push("EL rol no puede contener numeros ni caracetes especiales");
                            }else {

                            }
                        }
                        if(this.slug === ''){
                            this.errores.push("Introduzca el slug del nuevo rol");
                        }else {
                            this.slug= this.slug.trim();
                            if(patt2.test(this.slug) == false)
                            {
                                this.errores.push("EL slug  no puede contener espacios,numeros ni caracetes especiales distitos a '.'");
                            }else {

                            }
                        }
                        if(this.descripcion === ''){
                            this.errores.push("Introduzca la descripción del nuevo rol");
                        }else{
                            this.descripcion= this.descripcion.trim();
                            if(patt3.test(this.descripcion) == false)
                            {
                                this.errores.push("La descripción no puede contener numeros ni caracetes especiales");
                            }
                        }



                    if( this.errores.length === 0) {
                        document.getElementById('frmGuardar').submit();
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
    <!--  <script>
          var app = new Vue ({
              el:'#roles_create',
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

                  validar : function () {
                      var patt2 =  /^[a-zA-Z.]+$/; // para la afinidad
                      var patt3 = /^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/; //para la observación

                          if(this.rol === ''){
                              this.errores.push("Introduzca el nuevo rol");
                          } else{
                              this.rol = this.rol.trim();
                              if(patt3.test(this.rol) == false)
                              {
                                  this.errores.push("EL rol no puede contener numeros ni caracetes especiales");
                              }
                          }
                          if(this.slug === ''){
                              this.errores.push("Introduzca el slug del nuevo rol");
                          }else {
                              this.slug= this.slug.trim();
                              if(patt2.test(this.slug) == false)
                              {
                                  this.errores.push("EL slug  no puede contener espacios,numeros ni caracetes especiales distitos a '.'");
                              }
                          }
                          if(this.descripcion === ''){
                              this.errores.push("Introduzca la descripción del nuevo rol");
                          }else{
                              this.descripcion= this.descripcion.trim();
                              if(patt3.test(this.descripcion) == false)
                              {
                                  this.errores.push("La descripción no puede contener numeros ni caracetes especiales");
                              }
                          }

                      if( this.errores.length === 0) {
                          getElementsById('frmGuardar').submit();
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


      </script> -->

    <script type="text/javascript">
        $(document).ready(function() {
            $.get("/seguridad/rol/permisos", function (datos) {
                $.each(datos, function (key, value) {
                    $("#lista_permisos").append("<label><input type='checkbox' name='permisos[]' value= " + value.id + ">"+value.description +"</label><br>");
                });
            });
        });
    </script>
@endsection