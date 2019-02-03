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
            <label class="titulo"> Datos Personales</label>
        </div>
        <hr>
        <div id="cuerpoForm">
            <form>
                <section v-if="personal" id="datos personales">
                    <div class="form-group row col-md-12" > 
                    <label class="control-label col-md-3">Tipo de Identificación</label>
                    <select class="form-control col-md-2" v-model="tipo_identificacion">                    
                    </select>
                    <label class="control-label col-md-3" >Identificación</label >
                    <input class="form-control mx-1 col-md-3"type="text" v-model="identificacion" name="identificacion ">
                    </div>

                    <div class="form-group row col-md-12" > 
                    <label class="control-label col-md-3">Nombres</label>
                    <input class="form-control mx-1 col-md-8"type="text" v-model="nombre" name=" nombre ">
                    </div>

                    <div class="form-group row col-md-12" > 
                    <label class="control-label col-md-3">Apellidos</label>
                    <input class="form-control mx-1 col-md-8"type="text" v-model="apellido" name="apellido">
                    </div>

                    <div class="form-group row col-md-12" > 
                    <label class="control-label col-md-4">Fecha de Nacimiento</label>
                    <input class="form-control mx-1 col-md-5" type="date" v-model="fecha_nacimiento" name=" Nacionalidad ">
                    </div>

                    <div class="form-group row col-md-12" > 
                    <label class="control-label col-md-3" >Nacionalidad</label >
                    <input class="form-control mx-1 col-md-3"type="text" v-model="nacionalidad" name=" Nacionalidad ">
                    <label class="control-label col-md-2">Genero</label>
                    <select class="form-control col-md-3" v-model="genero">
                    <option value="FEMENINO">FEMENINO</option>
                    <option value="MASCULINO">MASCULINO</option>
                    </select>
                    </div>

                    <div class="form-group row col-md-12" > 
                    <label class="control-label col-md-3" >Carrera</label >
                    <input class="form-control mx-1 col-md-5"type="text" v-model="carrera" name=" Carrera ">
                    </div>

                    <div class="form-group row col-md-12" > 
                    <label class="control-label col-md-3">Discapacidad</label>
                    <select class="form-control col-md-3" v-model="discapacidad">
                    
                    </select>
                    <label class="control-label col-md-2" >Carnet Conadis</label >
                    <input class="form-control mx-1 col-md-3 "type="text" v-model="carnet_conadis" name="Carnet Conadis ">
                    </div>

                    <div class="form-group row col-md-12" > 
                    <label class="control-label col-md-3">Estado Civil</label>
                    <select class="form-control col-md-3" v-model="estado_civil">
                    </select>
                    <label class="control-label col-md-2" >Número de Hijos</label >
                    <input class="form-control mx-1 col-md-3"type="text" v-model="numero_hijos" name=" numero_hijos ">
                    
                    </div>     

                    <div class="form-group row col-md-12" > 
                    <label class="control-label col-md-3">País</label>
                    <select class="form-control col-md-3" v-model="pais">
                                               
                    </select>
                    <label class="control-label col-md-2" >Ciudad</label >
                    <select class="form-control col-md-3" v-model="ciudad">
                                               
                    </select>
                    </div>

                    <div class="form-group row col-md-12" > 
                    <label class="control-label col-md-3">Celular</label>
                    <input class="form-control mx-1 col-md-3"type="text" v-model="celular" name=" celular ">
                    <label class="control-label col-md-3">Convencional</label>
                    <input class="form-control mx-1 col-md-2"type="text" v-model="convencional" name="convencional">
                    </div>

                    <div class="form-group row col-md-12" > 
                    <label class="control-label col-md-3">Dirección</label>
                    <input class="form-control mx-1 col-md-8"type="text" v-model="direccion" name="Direccion">
                    </div>

                    <div class="form-group row col-md-12" > 
                    <label class="control-label col-md-3">Correo Electronico</label>
                    <input class="form-control mx-1 col-md-8"type="text" v-model="correo" name="Correo">
                    </div>

                    <div class="form-group row col-md-12" > 
                    <label class="control-label col-md-3">Etnia</label>
                    <select class="form-control col-md-4" v-model="etnia">
                                               
                    </select>
                    </div>
                    </section>

                    <section id="informacion profesional" v-if="profesional">
                    
                    <div class="form-group row col-md-12" > 
                    <label class="control-label col-md-8">Trabaja Acualmente, si su respuesta es NO de clic en continuar</label>
                    <select class="form-control col-md-3" v-model="trabajo_actual">
                    </select>
                    </div>

                    <div class="form-group row col-md-12" > 
                    <label class="control-label col-md-3">Tipo de Institución</label>
                    <select class="form-control col-md-4" v-model="tipo_institucion">
                    </select>
                    </div>

                    <div class="form-group row col-md-12" > 
                    <label class="control-label col-md-3">Nombre de la Empresa</label>
                    <input class="form-control mx-1 col-md-5"type="text" v-model="empresa" name=" celular ">
                    </div>

                    <div class="form-group row col-md-12" > 
                    <label class="control-label col-md-3">Actividad de la Empresa</label>
                    <select class="form-control col-md-3" v-model="actividad_empresa">
                    </select>
                    <label class="control-label col-md-3">Cargo que Ocupa</label>
                    <select class="form-control col-md-3" v-model="cargo">
                    </select>
                    </div>

                    <div class="form-group row col-md-12" > 
                    <label class="control-label col-md-5">Tiempo que se encuentra laborando</label>
                    <input class="form-control mx-1 col-md-2"type="number" v-model="tiempo_laborando" name=" celular ">
                    </div>

                    <div class="form-group row col-md-12" > 
                    <label class="control-label col-md-3">Tipo de Contrato</label>
                    <select class="form-control col-md-3" v-model="tipo_contrato">
                    </select>
                    <label class="control-label col-md-3">Rango de Sueldo</label>
                    <select class="form-control col-md-3" v-model="rango_sueldo">
                    </select>
                    </div>

                    <div class="form-group row col-md-12" > 
                    <label class="control-label col-md-3">A trabajado fuera de Ecuador </label>
                    <select class="form-control col-md-3" v-model="trabajo_exterior">
                    </select>
                    </div>

                    <div class="form-group col-md-12" > 
                    <label class="control-label col-md-12">Su carrera profesional se encuentra relacionado con el ambito laboral </label>
                    <select class="form-control col-md-3" v-model="relacion_carrera_profesional">
                    </select>
                    </div>

                    <div class="form-group col-md-12" > 
                    <label class="control-label col-md-12">Considera que su nivel de estudio se encuentra relacionado con el ambito laboral</label>
                    <select class="form-control col-md-3" v-model="nivel_estudio_acorde">
                    </select>
                    </div>

                    <div class="form-group col-md-12" > 
                    <label class="control-label col-md-12">¿Ha tenido dificultades al momento de conseguir empleo?</label>
                    <select class="form-control col-md-3" v-model="dificultad_para_trabajar">
                    </select>
                    </div>
                    </section>

                    <section id="institucion" v-if="institucion">
                    <div class="form-group col-md-12" > 
                    <label class="control-label col-md-10">¿Cómo calificaría la formación profesional recibida en el ITSVR?</label>
                    <select class="form-control col-md-3" v-model="formacion_profesional">
                    </select>
                    </div>
                    <div class="form-group row col-md-12" > 
                    <label class="control-label col-md-2">¿Por qué? </label>
                    <input class="form-control mx-1 col-md-5"type="text" v-model="formación_profesional_porque">
                    </div>
                    

                    <div class="form-check col-md-12" > 
                    <label class="form-chek-label">
                    Califique de manera general a los docentes en los siguientes aspectos (considerando Excelente=5, Muy buena=4,Buena = 3, Regular=2, Insuficiente=1) 
                    </label>
                    <table class="table">
                        <thead>
                            <tr>
                            <th>#</th>
                            <th>5</th>
                            <th>4</th>
                            <th>3</th>
                            <th>2</th>
                            <th>1</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <td>Dominio de la asignatura</td>
                            <td><input class="form-check-input" type="radio" name="calificacion_docente_dominio" ></td>
                            <td><input class="form-check-input" type="radio" name="calificacion_docente_dominio" ></td>
                            <td><input class="form-check-input" type="radio" name="calificacion_docente_dominio" ></td>
                            <td><input class="form-check-input" type="radio" name="calificacion_docente_dominio" ></td>
                            <td><input class="form-check-input" type="radio" name="calificacion_docente_dominio" ></td>
                            </tr>
                            <tr>
                            <td>Actualización en los conocimientos </td>
                            <td><input class="form-check-input" type="radio" name="calificacion_docente_actualizacion" ></td>
                            <td><input class="form-check-input" type="radio" name="calificacion_docente_actualizacion"></td>
                            <td><input class="form-check-input" type="radio" name="calificacion_docente_actualizacion" ></td>
                            <td><input class="form-check-input" type="radio" name="calificacion_docente_actualizacion" ></td>
                            <td><input class="form-check-input" type="radio" name="calificacion_docente_actualizacion" ></td>
                            </tr>
                            <tr>
                            <td>Metodologia de la enseñanza</td>
                            <td><input class="form-check-input" type="radio" name="calificacion_docente_metodologia" ></td>
                            <td><input class="form-check-input" type="radio" name="calificacion_docente_metodologia" ></td>
                            <td><input class="form-check-input" type="radio" name="calificacion_docente_metodologia" ></td>
                            <td><input class="form-check-input" type="radio" name="calificacion_docente_metodologia" ></td>
                            <td><input class="form-check-input" type="radio" name="calificacion_docente_metodologia" ></td>
                            </tr>
                            <tr>
                            <td>Fomento de las habilidades de análisis e Investigación </td>
                            <td><input class="form-check-input" type="radio" name="calificacion_docente_habilidades" ></td>
                            <td><input class="form-check-input" type="radio" name="calificacion_docente_habilidades" ></td>
                            <td><input class="form-check-input" type="radio" name="calificacion_docente_habilidades" ></td>
                            <td><input class="form-check-input" type="radio" name="calificacion_docente_habilidades" ></td>
                            <td><input class="form-check-input" type="radio" name="calificacion_docente_habilidades" ></td>
                            </tr>
                            <tr>
                            <td>Forma de evaluación </td>
                            <td><input class="form-check-input" type="radio" name="calificacion_docente_evaluacion" ></td>
                            <td><input class="form-check-input" type="radio" name="calificacion_docente_evaluacion"></td>
                            <td><input class="form-check-input" type="radio" name="calificacion_docente_evaluacion" ></td>
                            <td><input class="form-check-input" type="radio" name="calificacion_docente_evaluacion"></td>
                            <td><input class="form-check-input" type="radio" name="calificacion_docente_evaluacion" ></td>
                            </tr>
                        </tbody>
                        </table>

                    
                    
                            </div>
                            <div class="form-group col-md-12" > 
                            <label class="form-chek-label">
                            ¿Cuáles de los conocimientos adquiridos en la carrera, considera UD que son menos útiles para su ejercicio profesional?(Puede elegir varias opciones)</label>
                            </label>
                            </div>

                            <br>                   
                                <input class="form-check-input" type="checkbox" name="conocimientos_materias_profesionales">Materias de profesionalización
                                <br>
                                                
                                <input class="form-check-input" type="checkbox" name="conocimientos_comunicacion">Comunicación y Lingüística 
                                <br>

                                <input class="form-check-input" type="checkbox" name="conocimientos_materias_basicas">Materias básicas (Matemáticas, Computación, Sociales,etc)
                                <br>

                                <input class="form-check-input" type="checkbox" name="conocimientos_idiomas">Idiomas 
                                <br>

                                <input class="form-check-input" type="checkbox" name="conocimientos_otros">Otros 
                            <br>
                            <label class="control-label col-md-2">¿Por qué? </label>
                            <input class="form-control mx-1 col-md-5"type="text" v-model="conocimientos_menos_utiles_explique">
                            

                    
                        <div class="form-check col-md-12" > 
                        <label class="form-chek-label">
                        ¿Cómo calificaría usted los recursos con que cuenta la carrera ? (considerando Excelente=5, Muy buena=4,Buena = 3, Regular=2, Insuficiente=1) 
                        </label>
                            
                        <table class="table">
                            <thead>
                                <tr>
                                <th>#</th>
                                <th>5</th>
                                <th>4</th>
                                <th>3</th>
                                <th>2</th>
                                <th>1</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <td>Talento humano</td>
                                <td><input class="form-check-input" type="radio" name="recursos_de_la_carrera_talento"></td>
                                <td><input class="form-check-input" type="radio" name="recursos_de_la_carrera_talento"></td>
                                <td><input class="form-check-input" type="radio" name="recursos_de_la_carrera_talento"></td>
                                <td><input class="form-check-input" type="radio" name="recursos_de_la_carrera_talento"></td>
                                <td><input class="form-check-input" type="radio" name="recursos_de_la_carrera_talento"></td>
                                </tr>
                                <tr>
                                <td>Infraestructura</td>
                                <td><input class="form-check-input" type="radio" name="recursos_de_la_carrera_infraestructura"></td>
                                <td><input class="form-check-input" type="radio" name="recursos_de_la_carrera_infraestructura"></td>
                                <td><input class="form-check-input" type="radio" name="recursos_de_la_carrera_infraestructura"></td>
                                <td><input class="form-check-input" type="radio" name="recursos_de_la_carrera_infraestructura"></td>
                                <td><input class="form-check-input" type="radio" name="recursos_de_la_carrera_infraestructura"></td>
                                </tr>
                                <tr>
                                <td>Servicios</td>
                                <td><input class="form-check-input" type="radio" name="recursos_de_la_carrera_servicio"></td>
                                <td><input class="form-check-input" type="radio" name="recursos_de_la_carrera_servicio"></td>
                                <td><input class="form-check-input" type="radio" name="recursos_de_la_carrera_servicio"></td>
                                <td><input class="form-check-input" type="radio" name="recursos_de_la_carrera_servicio"></td>
                                <td><input class="form-check-input" type="radio" name="recursos_de_la_carrera_servicio"></td>
                                </tr>
                                <tr>
                                <td>Ambiente Tecnológico</td>
                                <td><input class="form-check-input" type="radio" name="recursos_de_la_carrera_ambiente"></td>
                                <td><input class="form-check-input" type="radio" name="recursos_de_la_carrera_ambiente"></td>
                                <td><input class="form-check-input" type="radio" name="recursos_de_la_carrera_ambiente"></td>
                                <td><input class="form-check-input" type="radio" name="recursos_de_la_carrera_ambiente"></td>
                                <td><input class="form-check-input" type="radio" name="recursos_de_la_carrera_ambiente"></td>
                                </tr>
                            </tbody>
                            </table>

                            <div class="form-check col-md-12" > 
                            <label class="form-chek-label">
                            Indique en qué áreas ha sentido mayores dificultades en el desempeño de su trabajo en general(considerando Excelente=5, Muy buena=4,Buena = 3, Regular=2, Insuficiente=1) 
                            </label>
                                
                        <table class="table">
                            <thead>
                                <tr>
                                <th>#</th>
                                <th>5</th>
                                <th>4</th>
                                <th>3</th>
                                <th>2</th>
                                <th>1</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <td>Trabajo en equipo</td>
                                <td><input class="form-check-input" type="radio" name="dificultad_general_trabajo_equipo"></td>
                                <td><input class="form-check-input" type="radio" name="dificultad_general_trabajo_equipo"></td>
                                <td><input class="form-check-input" type="radio" name="dificultad_general_trabajo_equipo"></td>
                                <td><input class="form-check-input" type="radio" name="dificultad_general_trabajo_equipo"></td>
                                <td><input class="form-check-input" type="radio" name="dificultad_general_trabajo_equipo"></td>
                                </tr>
                                <tr>
                                <td>Comunicación escrita</td>
                                <td><input class="form-check-input" type="radio" name="dificultad_general_comunicacion_escrita"></td>
                                <td><input class="form-check-input" type="radio" name="dificultad_general_comunicacion_escrita"></td>
                                <td><input class="form-check-input" type="radio" name="dificultad_general_comunicacion_escrita"></td>
                                <td><input class="form-check-input" type="radio" name="dificultad_general_comunicacion_escrita"></td>
                                <td><input class="form-check-input" type="radio" name="dificultad_general_comunicacion_escrita"></td>
                                </tr>
                                <tr>
                                <td>Comunicación oral</td>
                                <td><input class="form-check-input" type="radio" name="dificultad_general_comunicacion_oral"></td>
                                <td><input class="form-check-input" type="radio" name="dificultad_general_comunicacion_oral"></td>
                                <td><input class="form-check-input" type="radio" name="dificultad_general_comunicacion_oral"></td>
                                <td><input class="form-check-input" type="radio" name="dificultad_general_comunicacion_oral"></td>
                                <td><input class="form-check-input" type="radio" name="dificultad_general_comunicacion_oral"></td>
                                </tr>
                                <tr>
                                <td>Informática</td>
                                <td><input class="form-check-input" type="radio" name="dificultad_general_informatica"></td>
                                <td><input class="form-check-input" type="radio" name="dificultad_general_informatica"></td>
                                <td><input class="form-check-input" type="radio" name="dificultad_general_informatica"></td>
                                <td><input class="form-check-input" type="radio" name="dificultad_general_informatica"></td>
                                <td><input class="form-check-input" type="radio" name="dificultad_general_informatica"></td>
                                </tr>
                                <tr>
                                <td>Gestíon</td>
                                <td><input class="form-check-input" type="radio" name="dificultad_general_gestion"></td>
                                <td><input class="form-check-input" type="radio" name="dificultad_general_gestion"></td>
                                <td><input class="form-check-input" type="radio" name="dificultad_general_gestion"></td>
                                <td><input class="form-check-input" type="radio" name="dificultad_general_gestion"></td>
                                <td><input class="form-check-input" type="radio" name="dificultad_general_gestion"></td>
                                </tr>
                                <tr>
                                <td>Investigación</td>
                                <td><input class="form-check-input" type="radio" name="dificultad_general_investigacion"></td>
                                <td><input class="form-check-input" type="radio" name="dificultad_general_investigacion"></td>
                                <td><input class="form-check-input" type="radio" name="dificultad_general_investigacion"></td>
                                <td><input class="form-check-input" type="radio" name="dificultad_general_investigacion"></td>
                                <td><input class="form-check-input" type="radio" name="dificultad_general_investigacion"></td>
                                </tr>
                            </tbody>
                            </table>
                            <div class="form-group col-md-12" > 
                            <label class="control-label col-md-12"> En relación con su desempeño como graduado del ITSVR usted se encuentra</label>
                            <select class="form-control col-md-3" v-model="relacion_desempeño_descripcion ">
                            </select>
                            </div>

                    </section>  

                    <section v-if="preferencias" id="preferencias">
                    <div class="form-group row col-md-12" > 
                    <label class="control-label col-md-9">¿Está cursando actualmente estudios de pregrado? </label>
                    <select class="form-control col-md-3" v-model="estudios_pregrado">                    
                    </select>
                    </div>

                    <div class="form-group row col-md-12" > 
                    <label class="control-label col-md-9">¿Elegiría usted al ITSVR para realizar otra carrera? </label>
                    <select class="form-control col-md-3" v-model="otra_carrera">                    
                    </select>
                    </div>

                    <div class="form-group row col-md-12" > 
                    <label class="control-label col-md-9">¿Recomendaría usted al ITSVR, como Institución de Educación Superior?</label>
                    <select class="form-control col-md-3" v-model="recomendar_institucion">                    
                    </select>
                    </div>

                    <div class="form-group row col-md-12" > 
                    <label class="control-label col-md-9"> Temas de interés para cursos de  certificación de áreas</label>
                    <input class="form-control mx-1 col-md-5"type="text" v-model="temas_interes_r1">
                    <td>
                    <input class="form-control mx-1 col-md-5"type="text" v-model="temas_interes_r2">
                    </td>
                    </div>


                    </section>  

                    <section v-if="recomendaciones" id="recomendaciones">
                    <div class="form-group col-md-12" > 
                    <label class="control-label col-md-9"> ¿Qué contenidos cree usted que se deban incluir?</label>
                    <label class="control-label col-md-4"> Temas</label>
                    <input class="form-control mx-1 col-md-8"type="text" v-model="temas_incluir1">
                    <label class="control-label col-md-4"> Asignaturas</label>
                    <input class="form-control mx-1 col-md-8 "type="text" v-model="asignatura">
                    
                    </div>

                   
                   
                   
                   
            </form>

                
                
            
                      
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

                // if(boton == "next"){
                     // if(this.campo1 == ''){
                      //  console.log("error1")
                   // }else {
                        this.personal = false;
                        this.profesional = true;
                        this.seccionActual = 2;
                        this.btnAnterior = true;
                   // }
                 //}               
             },

             validarProfesional : function (boton) {

                 if(boton == "next"){
                  //    if(this.campo2 == ''){
                    //    console.log("error2")
                   // }else {
                        this.profesional = false;
                        this.institucion = true;
                        this.seccionActual = 3;
                    //}
                }else if(boton == "previous"){
                        this.personal = true;
                        this.profesional = false;
                        this.btnAnterior = false;
                        this.seccionActual = 1;
                 }
                   
             },

             validarInstitucion : function(boton){
                 if(boton == "next"){
                     //if(this.campo3 == ''){
                       // console.log("error3")
                    //}else {
                        this.institucion = false;
                        this.preferencias = true;
                        this.seccionActual = 4;
                    //}
                 }else if(boton == "previous"){
                        this.profesional = true;
                        this.institucion = false;
                        this.seccionActual = 2;
                 }



                    
             },

             validarPreferencias : function (boton) {
                 if(boton == "next"){
                     //if(this.campo4 == ''){
                      //  console.log("error4")
                   // }else {
                        this.preferencias = false;
                        this.recomendaciones = true;
                        this.seccionActual = 5;
                        this.btnEnviar =true;
                        this.btnSiguiente = false;
                    //}
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