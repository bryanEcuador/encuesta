<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Encuesta</title>
    <style>
        .barra {
            margin-bottom: 4px;
            margin-top: 15px;
            margin-left: 30px;
            margin-right: 30px;
        }

        .pasos {
            background: transparent;
            border-bottom-color: brown;
            border: 0;
            border-bottom: 4px solid transparent;
            padding: 0px 4px;
            transition: 1s;
        }

        .pasos:hover {
            border-bottom: 6px solid rgba(164, 59, 232, .4);
        }

        .seleccionado {
            border-bottom: 6px solid rgba(164, 59, 232, .9);
        }

        .titulo {
            font-size: 25px;
            color: black;
            text-align: center;
            margin: 5px;
            padding: 5px;
            display: block;
        }

        .piePagina {
            /* display: grid;
             grid-template-columns: auto; */
             position :relative;
             height: 60px;
        }

        .botones {
            margin: 5px;
            border-radius: 5px;
            padding: 8px;
        }

        .anterior {
            background: #269B87;
            color: azure;
            border-bottom-color: #2C554E;
            transition:  transform, cursor 1s;
            position: absolute;
            left: 0;
            bottom: 0;
            
        }

        .anterior:hover {
            cursor: pointer;
            font-size: 12;
             -webkit-transform: scale(1.1); /* Safari */
            transform: scale(1.1);
        }

        .siguiente {
             background: #269B87;
            color: azure;
            border-bottom-color: #2C554E;
            position: absolute;
            right: 0;
            bottom: 0;
            /* z-index: 1; */
            
        }

        .siguiente:hover {
              -webkit-transform: scale(1.1); /* Safari */
            transform: scale(1.1);
        }

        .enviar {
             background: #19AC93;
            color: azure;
            border-bottom-color: #2C554E;
            position: absolute; 
             right: 0;
            bottom: 0;
             
        }

        .enviar:hover {
              -webkit-transform: scale(1.1); /* Safari */
            transform: scale(1.1);
        }
    </style>
  </head>
  <body>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    {{-- formulario de encuesta --}}
    <div class="login-content" id="app">
        <div class="login-box">
            <div id="barraEstados" class="barra">
                <button v-bind:class="{pasos : true , seleccionado :personal}" @click="mover(1)" >Datos personales</button>
                <button v-bind:class="{pasos : true , seleccionado :profesional}" @click="mover(2)">información Profesional</button>
                <button v-bind:class="{pasos : true , seleccionado :institucion}" @click="mover(3)">institucion</button>
                <button v-bind:class="{pasos : true , seleccionado :preferencias}" @click="mover(4)">preferencias</button>
                <button v-bind:class="{pasos : true , seleccionado :recomendaciones}" @click="mover(5)">Recomendaciones</button>
        </div>
        
        <div>
            <label class="titulo"> Generico</label>
        </div>
        <hr>
        <div id="cuerpoForm">
            <form>
                <section v-if="personal" id="informacion personales">
                    <input type="text" v-model="campo1">
                </section>
                <section id="información profesional" v-if="profesional">
                    <input type="text" v-model="campo2">
                </section>
                <section id="institucion" v-if="institucion">
                    <input type="text" v-model="campo3">
                </section>
                <section id="preferencias" v-if="preferencias">
                    <input type="text" v-model="campo4">
                </section>
                <section id="Recomendaciones" v-if="recomendaciones">
                    <input type="text" v-model="campo5">    
                </section>          
        </form> 
        </div>

        <div class="piePagina">
            <button v-if="btnAnterior"  class="botones anterior" @click="anterior">Anterior</button>
            <button v-if="btnSiguiente" class="botones siguiente" @click="siguiente">Siguiente</button>
            <button v-if="btnEnviar"    class="botones enviar" @click="enviar">Enviar</button>
            
            <button style="visibility:hidden"></button>
        </div>
        </div>
        
    </div>
    <!-- Essential javascripts for application to work-->
    <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="{{asset('js/plugins/pace.min.js')}}"></script>
    <script type="text/javascript">
      // Login Page Flipbox control
      $('.login-content [data-toggle="flip"]').click(function() {
      	$('.login-box').toggleClass('flipped');
      	return false;
      });
    </script>
  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script>
     var app = new Vue ({
         el :'#app',


         data : {   
             // variables para moverse entre pestasllas
                personal : true,
                profesional : false,
                institucion : false,
                preferencias : false,
                recomendaciones: false,
                min : 1,
                max : 5,
                seccionActual : 1,
                btnEnviar :false,
                btnSiguiente : true,
                btnAnterior :false,

             // variables de info persona
                campo1 : '',
             // variables de info profesional
                campo2 : '',
             // variables de info institucion
                campo3 : '',
             // variables de info preferencias
                campo4 : '',
             // variables de info recomendacion   
                campo5 : '',
        },

         methods: {

             validarPersonal : function (boton) {
                 // comienzo validacion

                 if(boton == "next"){
                      if(this.campo1 == ''){
                        console.log("error1")
                    }else {
                        this.personal = false;
                        this.profesional = true;
                        this.seccionActual = 2;
                        this.btnAnterior = true;
                    }
                 }               
             },

             validarProfesional : function (boton) {

                 if(boton == "next"){
                      if(this.campo2 == ''){
                        console.log("error2")
                    }else {
                        this.profesional = false;
                        this.institucion = true;
                        this.seccionActual = 3;
                    }
                 }else if(boton == "previous"){
                        this.personal = true;
                        this.profesional = false;
                        this.btnAnterior = false;
                        this.seccionActual = 1;
                 }
                   
             },

             validarInstitucion : function(boton){
                 if(boton == "next"){
                     if(this.campo3 == ''){
                        console.log("error3")
                    }else {
                        this.institucion = false;
                        this.preferencias = true;
                        this.seccionActual = 4;
                    }
                 }else if(boton == "previous"){
                        this.profesional = true;
                        this.institucion = false;
                        this.seccionActual = 2;
                 }



                    
             },

             validarPreferencias : function (boton) {
                 if(boton == "next"){
                     if(this.campo4 == ''){
                        console.log("error4")
                    }else {
                        this.preferencias = false;
                        this.recomendaciones = true;
                        this.seccionActual = 5;
                        this.btnEnviar =true;
                        this.btnSiguiente = false;
                    }
                 }else if(boton == "previous"){
                        this.institucion = true;
                        this.preferencias = false;
                        this.seccionActual = 3;
                 }


                    
             },

             validarRecomendaciones : function (boton) {
                 if(boton == "next"){

                 }else if(boton == "previous"){
                      this.preferencias = true;
                      this.recomendaciones = false;
                      this.seccionActual = 4;
                      this.btnEnviar = false;
                      this.btnSiguiente = true;

                 }
             },

             siguiente : function(){
                 if(this.seccionActual == 1){
                    this.validarPersonal("next");
                 }else if(this.seccionActual == 2){
                    this.validarProfesional("next");
                 }else if(this.seccionActual == 3){
                     this.validarInstitucion("next");
                 }else if(this.seccionActual == 4) {
                     this.validarPreferencias("next");
                 }else {
                     // 
                     console.log("error");
                 }
             },

             anterior : function() {
                  if(this.seccionActual == 1){
                    this.validarPersonal("previous");
                 }else if(this.seccionActual == 2){
                    this.validarProfesional("previous");
                 }else if(this.seccionActual == 3){
                     this.validarInstitucion("previous");
                 }else if(this.seccionActual == 4) {
                     this.validarPreferencias("previous");
                 }else if(this.seccionActual == 5) {
                     this.validarRecomendaciones("previous");
                 }else {
                     // 
                     console.log("error");
                 }
             },

             enviar : function() {

             },

             mover : function(pestaña) {

                 // this.seccionActual -> Donde estoy ahora 
                 // pestaña -> a donde voy

                 if(pestaña == 1){

                 }else if (pestaña == 2) {

                 }else if (pestaña == 3) {
                     
                 }else if (pestaña == 4) {
                     
                 }else if (pestaña == 5) {
                     
                 }
             }
             
         },


     })
    
    
    </script>
  </body>
</html>