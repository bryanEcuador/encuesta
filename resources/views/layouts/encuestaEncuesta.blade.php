<!DOCTYPE html>
<html lang="es">
<head>
    <meta name="description" content="">
    <title>@yield('nombre_pagina')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/jpg" href="/favicon.jpg"/>
    <!-- Main CSS-->

    <link rel="stylesheet" type="text/css" href="/css/main.css">
    <link rel="stylesheet" type="text/css" href="/css/toastr.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    @yield('css')
</head>
<body class="app sidebar-mini rtl">
<!-- Navbar-->
<header class="app-header" ><a id="header" v-cloak class="app-header__logo" href="#"> itsvr encuesta </a>
    <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
    <!-- Navbar Right Menu-->

</header>

<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user">
    </div>
</aside>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1> @yield('icono') @yield('titulo de la pagina')</h1>
            <p>@yield('subtitulo')</p>
        </div>

        @yield('breadcrumbs')

    </div>
    <div class="row">
        @yield('contenido')
    </div>
</main>

<!-- Essential javascripts for application to work-->
<script src="/js/jquery-3.2.1.min.js"></script>
<script src="/js/popper.min.js"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
{{-- <script src="{{asset('js/tooltip.js')}}"></script>
 --}}
<!-- The javascript plugin to display page loading on top-->
<script src="{{asset('js/main.js')}}"></script>
<script src="/js/plugins/pace.min.js"></script>


<script src="{{asset('js/toastr.js')}}"></script>
<script src="{{asset('js/axios.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.5.13/dist/vue.js"></script>
<script>
    /*  var app = new Vue ({
             el:"#header",
             data: {
                cmbDatos : [],
                 nombre : '',

             },
             created : function() {
                 axios.get('/administrador/consultar/datos-pagina').then(response => {
                         this.cmbDatos = response.data,
                         this.nombre = this.cmbDatos[0].nombre

                     }).catch(error => {
                 });


             },

             methods : {



             }
         }
     ); */
</script>
@yield('js')
</body>
</html>