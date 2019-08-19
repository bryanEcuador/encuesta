<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style_form.css') }}">
        <!-- Font-icon css-->
        <title>Encuesta</title>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700" rel="stylesheet">
        <!-- Bootstrap Core CSS -->
        <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <!-- You can change the theme colors from here -->
        <link href="{{ asset('css/colors/default-dark.css') }}" id="theme" rel="stylesheet">
        <link href="{{ asset('css/sweetalert2.min.css') }}" id="theme" rel="stylesheet">
        <style type="text/css">
        .tamTableCol1 {
        width: 90%;
        }
        .tamTableCol2 {
        width: 10%;
        }
        @media(max-width: 768px){
        .tamTableCol1 {
        width: 50%;
        }
        .tamTableCol2 {
        width: 50%;
        }
        }
        </style>
    </head>
    <body class="fix-header card-no-border">
        <div id="main-wrapper">
            <div class=""> <!-- page-wrapper -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-outline-info">
                                <div class="card-header">
                                    <h4 class="mb-0 text-white">SEGUIMIENTO A GRADUADOS</h4>
                                </div>
                                <div class="card-body">
                                    <form action="#">
                                        @csrf
                                        <div class="form-body">
                                            <div id="datos_personales">
                                                <div class="card-header">
                                                    <h4 class="mb-0 text-white">DATOS PERSONALES</h4>
                                                </div>
                                                <hr/>
                                                <div class="row pt-3">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Identificaci&oacute;n</label>
                                                            <input type="text" id="fcedula" class="form-control" placeholder="Ingrese su Identificaci&oacute;n" required>
                                                            <div class="invalid-feedback">Por favor ingresa un n&uacute;mero de cedula v&aacute;lida.</div>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                    <div class="col-md-6">
                                                        <div class="form-group"><!--has-danger-->
                                                            <label class="control-label">Nombre y Apellido</label>
                                                            <input type="text" id="fnombre" class="form-control" placeholder="Ingrese su nombre y apellido" required>
                                                            <div class="invalid-feedback">Por favor ingrese su nombre y apellido.</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Fecha de Nacimiento</label>
                                                            <input type="date" class="form-control" id="fnacimiento" placeholder="dd/mm/yyyy">
                                                            <div class="invalid-feedback">Por favor ingrese una fecha de nacimiento v&aacute;lida.</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group"><!--has-danger-->
                                                            <label class="control-label">Nacionalidad</label>
                                                            <input type="text" id="fnacionalidad" class="form-control" placeholder="Ingrese su nacionalidad">
                                                            <div class="invalid-feedback">Por favor ingrese su nacionalidad.</div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">G&eacute;nero</label>
                                                            <select class="form-control custom-select" id="fgenero">
                                                                <option value="-">--</option>
                                                                <option value="M">Masculino</option>
                                                                <option value="F">Femenino</option>
                                                            </select>
                                                            <div class="invalid-feedback">Por escoja un genero v&aacute;lido.</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Fecha de Graduaci&oacute;n</label>
                                                            <input type="date" id="fgraduacion" class="form-control" placeholder="dd/mm/yyyy">
                                                            <div class="invalid-feedback">Por favor ingrese una fecha de graduacion v&aacute;lida.</div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Carrera</label>
                                                            <select class="form-control custom-select" id="fcarrera">
                                                                <option value="--">--</option>
                                                                <option value="HT">Hoteler&iacute;a y Turismo</option>
                                                                <option value="CE">Comercio Exterior</option>
                                                                <option value="BF">Banca y Finanzas</option>
                                                                <option value="PS">Promoci&oacute;n de la Salud</option>
                                                                <option value="MR">Mantenimiento e Insatalaci&oacute;n de Redes</option>
                                                                <option value="EE">Ensamblaje de Equipos de C&oacute;mputo</option>
                                                                <option value="DI">Desarrollo Infantil Integral</option>
                                                                <option value="TA">TAPS</option>
                                                            </select>
                                                            <div class="invalid-feedback">Por favor elija una carrera v&aacute;lida.</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Tiene Alguna Discapacidad</label>
                                                            <div class="mb-2">
                                                                <label class="custom-control custom-radio">
                                                                    <input id="fsi_disc" name="fsi_no_disc" type="radio" value="S" class="custom-control-input">
                                                                    <span class="custom-control-label">SI</span>
                                                                </label>
                                                                <label class="custom-control custom-radio">
                                                                    <input id="fno_disc" name="fsi_no_disc" type="radio" value="N" class="custom-control-input" checked>
                                                                    <span class="custom-control-label">NO</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="control-label">Nro. Carnet CONADIS</label>
                                                            <input type="text" id="fncarnet" class="form-control" placeholder="Ingrese el numero de carnet">
                                                            <div class="invalid-feedback">Por favor ingrese su n&uacute;mero de carnet.</div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-actions">
                                                    <button type="button" id="next_datos_personales" class="btn btn-success">Siguiente <i class="fas fa-share"></i></button>
                                                </div>
                                            </div>

                                            <div id="informacion_personal" style="display: none;">
                                                <div class="card-header">
                                                    <h4 class="mb-0 text-white">INFORMACI&Oacute;N PERSONAL</h4>
                                                </div>
                                                <hr/>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Estado Civil</label>
                                                            <select class="form-control custom-select" id="fcivil">
                                                                <option value="-">--</option>
                                                                <option value="S">Soltero</option>
                                                                <option value="C">Casado</option>
                                                                <option value="U">Union Libre</option>
                                                                <option value="C">Viudo</option>
                                                                <option value="D">Divorciado</option>
                                                            </select>
                                                            <div class="invalid-feedback">Por favor seleccione un estado civil v&aacute;lido.</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>N&uacute;mero de Hijo</label>
                                                            <input type="text"  id="fnumhijos" class="form-control" placeholder="Ingrese el numero de hijos">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Pa&iacute;s de residencia</label>
                                                            <select class="form-control custom-select" id="fpais">
                                                                <option value="--">--</option>
                                                                <option value="EC">Ecuador</option>
                                                                <option value="MX">Mexico</option>
                                                                <option value="FR">Francia</option>
                                                            </select>
                                                            <div class="invalid-feedback">Seleccione un Pa&iacute;s v&aacute;lido.</div>
                                                        </div>`
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Ciudad</label>
                                                            <select class="form-control custom-select" id="fciudad">
                                                                <option value="--">--</option>
                                                                <option value="GU">Guayaquil</option>
                                                                <option value="NA">Naranjal</option>
                                                                <option value="OT">Otro</option>
                                                            </select>
                                                            <div class="invalid-feedback">Seleccione una ciudad v&aacute;lida.</div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Nro. Celular</label>
                                                            <input type="text" id="fcelular" class="form-control" placeholder="Ingrese su n&uacute;mero de celular">
                                                            <div class="invalid-feedback">Por favor ingresa un n&uacute;mero de celular v&aacute;lido.</div>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Nro. Convencional</label>
                                                            <input type="text" id="fconvencional" class="form-control" placeholder="Ingrese su n&uacute;mero convencional">
                                                            <div class="invalid-feedback">Por favor ingresa un n&uacute;mero convencional v&aacute;lido.</div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Direcci&oacute;n</label>
                                                            <input type="text" id="fdireccion" class="form-control" placeholder="Ingrese su direccion domicilaria">
                                                            <div class="invalid-feedback">Ingrese su direcci&oacute;n domicilaria.</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Correo Personal</label>
                                                            <input type="text" id="fcorreo" class="form-control" placeholder="Ingrese su correo personal">
                                                            <div class="invalid-feedback">Por favor ingrese un correo personal.</div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Etnia</label>
                                                            <select class="form-control custom-select" id="fetnia">
                                                                <option value="--">--</option>
                                                                <option value="IN">Indigena</option>
                                                                <option value="AF">AfrorEcuatoriano</option>
                                                                <option value="NE">Negro</option>
                                                                <option value="MU">Mulato</option>
                                                                <option value="MO">Montubio</option>
                                                            </select>
                                                            <div class="invalid-feedback">Por favor seleccione una etnia v&aacute;lida.</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button" id="back_informacion_personales" class="btn btn-inverse">Atras <i class="fas fas fa-reply"></i></button>
                                                <button type="button" id="next_informacion_personales" class="btn btn-success">Siguiente <i class="fas fa-share"></i></button>
                                            </div>

                                            <div id="informacion_profesional" style="display: none;">
                                                <div class="card-header">
                                                    <h4 class="mb-0 text-white">INFORMACI&Oacute;N PROFESIONAL</h4>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="control-label"> ¿Trabaja actualmente ? Si su respuesta es NO, de clic en contininar</label>
                                                            <div class="mb-2">
                                                                <label class="custom-control custom-radio">
                                                                    <input id="fsi_work" name="fsi_no_work" value="S" type="radio" class="custom-control-input">
                                                                    <span class="custom-control-label">SI</span>
                                                                </label>
                                                                <label class="custom-control custom-radio">
                                                                    <input id="fno_work" name="fsi_no_work" value="N" type="radio" class="custom-control-input" checked>
                                                                    <span class="custom-control-label">NO</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div id="show_data" style="display: none;">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Tipo de institucion donde labora</label>
                                                                <select id="fLabora" class="form-control custom-select">
                                                                    <option value="--">--</option>
                                                                    <option value="PU">Publica</option>
                                                                    <option value="FA">Familiar</option>
                                                                    <option value="NE">Negocio/Emprendimiento</option>
                                                                    <option value="PR">Propio</option>
                                                                    <option value="IN">Independiente</option>
                                                                </select>
                                                                <div class="invalid-feedback">Seleccione un tipo de instituci&oacute;n v&aacute;lida.</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Nombre de la empresa</label>
                                                                <input type="text" id="fnameEmpresa" class="form-control" placeholder="Ingrese el nombre de la empresa">
                                                                <div class="invalid-feedback">Por favor ingrese el nombre de la empresa.</div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Actividad Empresarial</label>
                                                                <input type="text" id="factividad" class="form-control" placeholder="Ingrese la actividad empresarial">
                                                                <div class="invalid-feedback">Por favor ingrese la actividad que realiza la empresa.</div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Cargo que ocupa</label>
                                                                <input type="text" id="fcargo" class="form-control" placeholder="Ingrese el cargo">
                                                                <div class="invalid-feedback">Por favor ingrese el cargo.</div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Tiempo que se encuentra laborando</label>
                                                                <input type="text" id="ftime" class="form-control" placeholder="Ingrese el tiempo laboral">
                                                                <div class="invalid-feedback">Por favor ingrese el tiempo laboral.</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Rango de Sueldos</label>
                                                                <select class="form-control custom-select" id="frango">
                                                                    <option value="--">--</option>
                                                                    <option value="1">$354 a $500</option>
                                                                    <option value="2">$501 a $1000</option>
                                                                    <option value="3">$1501 y $2000</option>
                                                                    <option value="4">$2001 y $2500</option>
                                                                    <option value="5">Mayor a $2501</option>
                                                                </select>
                                                                <div class="invalid-feedback">Rango de sueldos invalido.</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>¿A trabajado fuera de Ecuador?</label>
                                                                <label class="custom-control custom-radio">
                                                                    <input id="fsi_ecuador" name="fsi_no_ecuador" type="radio" class="custom-control-input">
                                                                    <span class="custom-control-label">SI</span>
                                                                </label>
                                                                <label class="custom-control custom-radio">
                                                                    <input id="fno_ecuador" name="fsi_no_ecuador" type="radio" class="custom-control-input" checked>
                                                                    <span class="custom-control-label">NO</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Cuan relacionada  se encuentra su carrera profesional con las funciones que usted desempeña en el ambito laboral actualmente?</label>
                                                                <select class="form-control custom-select" id="frelacion_cargo">
                                                                    <option value="--">--</option>
                                                                    <option value="DI">Directamente Relacionado</option>
                                                                    <option value="IN">Indirectamente Relacionado</option>
                                                                    <option value="NR">Nada Relacionado</option>
                                                                </select>
                                                                <div class="invalid-feedback">Por favor seleccione una opci&oacute;n valida.</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Considera Usted que su nivel de estudio se encuentra adecuadamente acorde al cargo que desempeña en su trabajo</label>
                                                                <select class="form-control custom-select" id="fcargo_correcto">
                                                                    <option value="--">--</option>
                                                                    <option value="DI">Muy de acuerdo</option>
                                                                    <option value="IN">Parcialmente de acuerdo</option>
                                                                    <option value="NR">Medianamente en Desacuerdo</option>
                                                                    <option value="NR">Desacuerdo</option>
                                                                </select>
                                                                <div class="invalid-feedback">Por favor seleccione una opci&oacute;n valida.</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>¿Ha tenido dificultades al momento de conseguir empleo? </label>
                                                                <label class="custom-control custom-radio">
                                                                    <input id="fsi_empleo" name="fsi_noempleo" type="radio" class="custom-control-input">
                                                                    <span class="custom-control-label">SI</span>
                                                                </label>
                                                                <label class="custom-control custom-radio">
                                                                    <input id="fno_empleo" name="fsi_noempleo" type="radio" class="custom-control-input" checked>
                                                                    <span class="custom-control-label">NO</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button" id="back_informacion_profesional" class="btn btn-inverse">Atras <i class="fas fas fa-reply"></i></button>
                                                <button type="button" id="next_informacion_profesional" class="btn btn-success">Siguiente <i class="fas fa-share"></i></button>
                                            </div>                                
                                            
                                            <div id="instituto_carrera" style="display: none;">
                                                <div class="card-header">
                                                    <h4 class="mb-0 text-white">INSTITUTO/CARRERA/RECURSO</h4>
                                                </div>
                                                <hr/>

                                                <div class="row pt-3">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">¿C&oacute;mo calificar&iacute;a la formaci&oacute;n profesional recibida en el ITSVR?</label>
                                                            <select class="form-control custom-select" id="fcalifica">
                                                                <option value="--">--</option>
                                                                <option value="EX">Excelente</option>
                                                                <option value="MB">Muy Buena</option>
                                                                <option value="BU">Buena</option>
                                                                <option value="RE">Regular</option>
                                                                <option value="IN">Insuficiente</option>
                                                            </select>
                                                            <div class="invalid-feedback">Por favor seleccione una opci&oacute;n v&aacute;lida.</div>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                    <div class="col-md-6">
                                                        <div class="form-group"><!--has-danger-->
                                                            <label class="control-label">Porque?</label>
                                                            <input type="text" id="fporque" class="form-control" placeholder="Ingrese un porque">
                                                            <div class="invalid-feedback">Por favor ingrese el motivo.</div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="control-label">Califique de manera general a los docentes en los siguientes aspectos (considerando la m&aacute;xima calificaci&oacute;n 5 y la m&iacute;nima):</label>
                                                            <div class="container">
                                                                <ol class="card-subtitle">
                                                                    <li>Insuficiente</li>
                                                                    <li>Regular</li>
                                                                    <li>Buena</li>
                                                                    <li>Muy buena</li>
                                                                    <li>Excelente</li>
                                                                </ol>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <table style="clear: both" class="table table-bordered table-striped" id="user">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="tamTableCol1">Dominio de la asignatura</td>
                                                                    <td class="tamTableCol2">
                                                                        <input type="number" class="form-control" style="text-align: center;" id="fdominio" min="1" max="5" step="1" value="1"  required="required">
                                                                        <div class="invalid-feedback">Valor no permitido.</div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Actualizaci&oacute;n en los conocimientos</td>
                                                                    <td>
                                                                        <input type="number" class="form-control" style="text-align: center;" id="fact" min="1" max="5" step="1" value="1"  required="required">
                                                                        <div class="invalid-feedback">Valor no permitido.</div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Metodologia de la ense&ntilde;anza</td>
                                                                    <td>
                                                                        <input type="number" class="form-control" style="text-align: center;" id="fmetodologia" min="1" max="5" step="1" value="1"  required="required">
                                                                        <div class="invalid-feedback">Valor no permitido.</div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Fomento de las habilidades de an&aacute;lisis e Investigaci&oacute;n</td>
                                                                    <td>
                                                                        <input type="number" class="form-control" style="text-align: center;" id="fhabilidades" min="1" max="5" step="1" value="1"  required="required">
                                                                        <div class="invalid-feedback">Valor no permitido.</div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Forma de evaluaci&oacute;n</td>
                                                                    <td>
                                                                        <input type="number" class="form-control" style="text-align: center;" id="fevaluaciones" min="1" max="5" step="1" value="1"  required="required">
                                                                        <div class="invalid-feedback">Valor no permitido.</div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="control-label">¿Cu&aacute;les de los conocimientos adquiridos en la carrera, considera UD que son menos &uacute;tiles para su ejercicio profesional?</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12" style="background-color: #f0f1f5; padding: 10px; margin: 10px auto;">
                                                        <div class="checkbox checkbox-primary">
                                                            <input id="finputPerso" type="checkbox" >
                                                            <label for="finputPerso"> Materias de profesionalizaci&oacute;n</label>
                                                        </div>
                                                        <div class="checkbox checkbox-primary">
                                                            <input id="finputmateria" type="checkbox" >
                                                            <label for="finputmateria"> Materias b&aacute;sicas (Matem&aacute;ticas, Computaci&oacute;n, Estudios empresariales y Sociales)</label>
                                                        </div>
                                                        <div class="checkbox checkbox-primary">
                                                            <input id="finputcomuni" type="checkbox" >
                                                            <label for="finputcomuni"> Comunicaci&oacute;n y Lingüística </label>
                                                        </div>
                                                        <div class="checkbox checkbox-primary">
                                                            <input id="finputExplique" type="checkbox" >
                                                            <label for="finputExplique"> Otros, explique: 
                                                                <input id="finputExplique_" class="form-control" type="text" style="width: 40%;">
                                                                <div class="invalid-feedback" style="text-align: center;">Por favor ingrese una explicaci&oacute;n.</div>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="control-label">¿C&oacute;mo calificar&iacute;a usted los recursos con que cuenta la carrera? (considerando la m&aacute;xima calificaci&oacute;n 5 y la m&iacute;nima):</label>
                                                            <div class="container">
                                                                <ol class="card-subtitle">
                                                                    <li>Insuficiente</li>
                                                                    <li>Regular</li>
                                                                    <li>Buena</li>
                                                                    <li>Muy buena</li>
                                                                    <li>Excelente</li>
                                                                </ol>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <table style="clear: both" class="table table-bordered table-striped">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="tamTableCol1">Talento humano</td>
                                                                    <td class="tamTableCol2">
                                                                        <input type="number" class="form-control" style="text-align: center;" id="ftalento" min="1" max="5" step="1" value="1"  required="required">
                                                                        <div class="invalid-feedback">Valor no permitido.</div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Infraestructura</td>
                                                                    <td>
                                                                        <input type="number" class="form-control" style="text-align: center;" id="finfra" min="1" max="5" step="1" value="1"  required="required">
                                                                        <div class="invalid-feedback">Valor no permitido.</div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Servicios</td>
                                                                    <td>
                                                                        <input type="number" class="form-control" style="text-align: center;" id="fservicio" min="1" max="5" step="1" value="1"  required="required">
                                                                        <div class="invalid-feedback">Valor no permitido.</div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Ambiente Tecnol&oacute;gico</td>
                                                                    <td>
                                                                        <input type="number" class="form-control" style="text-align: center;" id="fambTecno" min="1" max="5" step="1" value="1"  required="required">
                                                                        <div class="invalid-feedback">Valor no permitido.</div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="control-label"> Indique en qué áreas ha sentido mayores dificultades en el desempeño de su trabajo en general, Califique los siguientes elementos con un orden de prioridad (considerando la m&aacute;xima calificaci&oacute;n 5 y la m&iacute;nima):</label>
                                                            <div class="container">
                                                                <ol class="card-subtitle">
                                                                    <li>Insuficiente</li>
                                                                    <li>Regular</li>
                                                                    <li>Buena</li>
                                                                    <li>Muy buena</li>
                                                                    <li>Excelente</li>
                                                                </ol>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <table style="clear: both" class="table table-bordered table-striped" id="user">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="tamTableCol1">Trabajo en equipo</td>
                                                                    <td class="tamTableCol2">
                                                                        <input type="number" class="form-control" style="text-align: center;" id="fwork" min="1" max="5" step="1" value="1"  required="required">
                                                                        <div class="invalid-feedback">Valor no permitido.</div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Comunicaci&oacute;n escrita</td>
                                                                    <td>
                                                                        <input type="number" class="form-control" style="text-align: center;" id="fcomescri" min="1" max="5" step="1" value="1"  required="required">
                                                                        <div class="invalid-feedback">Valor no permitido.</div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Comunicaci&oacute;n oral</td>
                                                                    <td>
                                                                        <input type="number" class="form-control" style="text-align: center;" id="fcomunicacion" min="1" max="5" step="1" value="1"  required="required">
                                                                        <div class="invalid-feedback">Valor no permitido.</div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Inform&aacute;tica</td>
                                                                    <td>
                                                                        <input type="number" class="form-control" style="text-align: center;" id="finformatica" min="1" max="5" step="1" value="1"  required="required">
                                                                        <div class="invalid-feedback">Valor no permitido.</div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Gest&iacute;on</td>
                                                                    <td>
                                                                        <input type="number" class="form-control" style="text-align: center;" id="fgestion" min="1" max="5" step="1" value="1"  required="required">
                                                                        <div class="invalid-feedback">Valor no permitido.</div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Investigaci&oacute;n</td>
                                                                    <td>
                                                                        <input type="number" class="form-control" style="text-align: center;" id="finvestiga" min="1" max="5" step="1" value="1"  required="required">
                                                                        <div class="invalid-feedback">Valor no permitido.</div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">En relaci&oacute;n con su desempe&ntilde;o como graduado del ITSVR usted se encuentra:</label>
                                                            <select class="form-control custom-select" id="fITSVR">
                                                                <option value="--">--</option>
                                                                <option value="MUS">Muy satisfecho</option>
                                                                <option value="SAS">Satisfecho</option>
                                                                <option value="MES">Medio satisfecho</option>
                                                                <option value="INS">Insatisfecho</option>
                                                            </select>
                                                            <div class="invalid-feedback">Selecci&oacute;n Invalida.</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button" id="back_instituto_carrera" class="btn btn-inverse">Atras <i class="fas fas fa-reply"></i></button>
                                                <button type="button" id="next_instituto_carrera" class="btn btn-success">Siguiente <i class="fas fa-share"></i></button>
                                            </div>
                                            
                                            <div id="referencias_estudio" style="display: none;">
                                                <div class="card-header">
                                                    <h4 class="mb-0 text-white">PREFERENCIAS DE ESTUDIO</h4>
                                                </div>
                                                <hr/>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label class="control-label">¿Est&aacute; cursando actualmente estudios de pregrado?</label>
                                                        <div class="mb-2">
                                                            <label class="custom-control custom-radio">
                                                                <input id="fsi_pregrado" name="fsi_no_pregrado" type="radio" class="custom-control-input">
                                                                <span class="custom-control-label">SI</span>
                                                            </label>
                                                            <label class="custom-control custom-radio">
                                                                <input id="fno_pregrado" name="fsi_no_pregrado" type="radio" class="custom-control-input" checked>
                                                                <span class="custom-control-label">NO</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                    <div class="col-md-6">
                                                        <label class="control-label">¿Elegir&iacute;a usted al ITSVR para realizar otra carrera?</label>
                                                        <div class="mb-2">
                                                            <label class="custom-control custom-radio">
                                                                <input id="fsi_ITSVR" name="fsi_no_ITSVR" type="radio" class="custom-control-input">
                                                                <span class="custom-control-label">SI</span>
                                                            </label>
                                                            <label class="custom-control custom-radio">
                                                                <input id="fno_ITSVR" name="fsi_no_ITSVR" type="radio" class="custom-control-input" checked>
                                                                <span class="custom-control-label">NO</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label class="control-label">¿Recomendar&iacute;a usted al ITSVR, como Instituci&oacute;n de Educaci&oacute;n Superior?</label>
                                                        <div class="mb-2">
                                                            <label class="custom-control custom-radio">
                                                                <input id="fsi_recomendacion" name="fsi_no_recomendacion" type="radio" class="custom-control-input">
                                                                <span class="custom-control-label">SI</span>
                                                            </label>
                                                            <label class="custom-control custom-radio">
                                                                <input id="fno_recomendacion" name="fsi_no_recomendacion" type="radio" class="custom-control-input" checked>
                                                                <span class="custom-control-label">NO</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                    <div class="col-md-6">
                                                        <label class="control-label">Temas de inter&eacute;s para cursos de  certificaci&oacute;n de &aacute;reas</label>
                                                        <div class="mb-2">
                                                            <textarea id="txt_temas" class="form-control" style="width: 100%;" rows="4"></textarea>
                                                            <div class="invalid-feedback">Escriba un tema de interes.</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button" id="back_referencias_estudio" class="btn btn-inverse">Atras <i class="fas fas fa-reply"></i></button>
                                                <button type="button" id="next_referencias_estudio" class="btn btn-success">Siguiente <i class="fas fa-share"></i></button>
                                            </div>
                                            
                                            <div id="recomendaciones_sugerencias" style="display: none;">
                                                <div class="card-header">
                                                    <h4 class="mb-0 text-white">RECOMENDACIONES O SUGERENCIAS</h4>
                                                </div>
                                                <hr/>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label class="control-label">¿Qu&eacute; contenidos cree usted que se deban incluir?</label>
                                                        <div class="mb-2">
                                                            <textarea id="txt_recomen_temas" class="form-control" style="width: 100%;" rows="3" placeholder="Ingrese contenido a incluir"></textarea>
                                                            <div class="invalid-feedback">Ingrese contenido a incluir.</div>
                                                        </div>
                                                        <div class="mb-2">
                                                            <textarea id="txt_recomen_asignatura" class="form-control" style="width: 100%;" rows="3" placeholder="Ingrese las asignaturas a incluir"></textarea>
                                                            <div class="invalid-feedback">Ingrese las asignaturas a incluir.</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-actions">
                                                    <button type="button" id="back_recomendaciones" class="btn btn-inverse">Atras <i class="fas fas fa-reply"></i></button>
                                                    <button type="button" id="save_recomendaciones" class="btn btn-success"> <i class="fa fa-check"></i> Guardar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/jquery.validate.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
        <script type="text/javascript">
        $(function(){

            $("#fsi_work").on('click', function(){
                $('#show_data').show();
            })

            $("#fno_work").on('click', function(){
                $('#show_data').hide();
            })

            $('#fcedula').on('input', function () { 
                this.value = this.value.replace(/[^0-9]/g,'');
            });

            $('#fncarnet').on('input', function(){
                this.value = this.value.replace(/[^0-9]/g,'');
            });

            $('#next_datos_personales').on('click', function(){
                var cedula = $('#fcedula').val();
                var nombre = $('#fnombre').val();
                var fecha_nacimiento = $('#fnacimiento').val();
                var nacionalidad = $('#fnacionalidad').val();
                var genero = $('#fgenero').val();
                var fecha_graduacion = $('#fgraduacion').val();
                var carrera = $('#fcarrera').val();
                var carnet = $('#fncarnet').val();
                var isDiscapacitado = $('input[name=fsi_no_disc]:checked').val()
                
                var isError = false;

                if (cedula.length <= 0 || cedula.length > 10 || cedula.length < 10){
                    $('#fcedula').addClass('is-invalid');
                    isError = true;
                }else{
                    $('#fcedula').removeClass('is-invalid');
                }

                if(nombre.length <= 0){
                    $('#fnombre').addClass('is-invalid');
                    isError = true;
                }else{
                    $('#fnombre').removeClass('is-invalid');
                }

                if(fecha_nacimiento.length <= 0){
                    $('#fnacimiento').addClass('is-invalid');
                    isError = true;
                }else{
                    $('#fnacimiento').removeClass('is-invalid');
                }

                if(nacionalidad.length <= 0){
                    $('#fnacionalidad').addClass('is-invalid');
                    isError = true;
                }else{
                    $('#fnacionalidad').removeClass('is-invalid');
                }

                if(genero.length <= 0 || genero == '-'){
                    $('#fgenero').addClass('is-invalid');
                    isError = true;
                }else{
                    $('#fgenero').removeClass('is-invalid');
                }

                if(fecha_graduacion.length <= 0){
                    $('#fgraduacion').addClass('is-invalid');
                    isError = true;
                }else{
                    $('#fgraduacion').removeClass('is-invalid');
                }

                if(carrera.length <= 0 || carrera == '--'){
                    $('#fcarrera').addClass('is-invalid');
                    isError = true;
                }else{
                    $('#fcarrera').removeClass('is-invalid');
                }

                if(isDiscapacitado.toUpperCase() == 'S') {  
                    if (carnet.length <= 0 || (carnet.length < 10 || carnet.length > 10)){
                        $('#fncarnet').addClass('is-invalid');
                        isError = true;
                        
                    }else{
                        $('#fncarnet').removeClass('is-invalid');
                    }
                }else{
                    $('#fncarnet').removeClass('is-invalid');
                }

                if(!isError){
                    $('#informacion_personal').show();
                    $('#datos_personales').hide();
                }

            });

            $('#back_informacion_personales').on('click', function(){
                $('#informacion_personal').hide();
                $('#datos_personales').show();
            });

            function isEmail(email) {
              var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
              return regex.test(email);
            }

            $('#fcelular').on('input', function(){
               this.value = this.value.replace(/[^0-9]/g,''); 
            });

            $('#fconvencional').on('input', function(){
                this.value = this.value.replace(/[^0-9]/g,'');
            });

            $('#fnumhijos').on('input', function(){
               this.value = this.value.replace(/[^0-9]/g,''); 
            });

            $('#ftime').on('input', function(){
               this.value = this.value.replace(/[^0-9]/g,''); 
            });

            $('#next_informacion_personales').on('click', function() {
                var isError = false;
                var estado_civil = $('#fcivil').val();
                var pais = $('#fpais').val();
                var ciudad = $('#fciudad').val();
                var celular = $('#fcelular').val();
                var direccion = $('#fdireccion').val();
                var correo = $('#fcorreo').val();
                var etnia = $('#fetnia').val();
                var convencional = $('#fconvencional').val();

                if (estado_civil.length <= 0 || estado_civil == '-'){
                    $('#fcivil').addClass('is-invalid');
                    isError = true;
                }else{
                    $('#fcivil').removeClass('is-invalid');
                }

                if (pais.length <= 0 || pais == '--'){
                    $('#fpais').addClass('is-invalid');
                    isError = true;
                }else{
                    $('#fpais').removeClass('is-invalid');
                }

                if (ciudad.length <= 0 || ciudad == '--'){
                    $('#fciudad').addClass('is-invalid');
                    isError = true;
                }else{
                    $('#fciudad').removeClass('is-invalid');
                }

                if (celular.length <= 0 || celular.length < 10 || celular.length > 10){
                    $('#fcelular').addClass('is-invalid');
                    isError = true;
                }else{
                    $('#fcelular').removeClass('is-invalid');
                }

                if (convencional.length > 0){
                    if (convencional.length < 7){
                        $('#fconvencional').addClass('is-invalid');
                        isError = true;
                    }
                    else{
                        $('#fconvencional').removeClass('is-invalid');
                    }
                }


                if (direccion.length <= 0){
                    $('#fdireccion').addClass('is-invalid');
                    isError = true;
                }else{
                    $('#fdireccion').removeClass('is-invalid');
                }

                if (correo.length <= 0){
                    $('#fcorreo').addClass('is-invalid');
                    isError = true;
                }else{
                    if(isEmail(correo)){
                        $('#fcorreo').removeClass('is-invalid');
                    }else{
                        $('#fcorreo').addClass('is-invalid');
                        isError = true;
                    }
                }

                if (etnia.length <= 0 || etnia == '--'){
                    $('#fetnia').addClass('is-invalid');
                    isError = true;
                }else{
                    $('#fetnia').removeClass('is-invalid');
                }

                

                if (!isError){
                    $('#informacion_personal').hide();
                    $('#informacion_profesional').show();
                }
            });

            $('#back_informacion_profesional').on('click', function(){
                $('#informacion_profesional').hide();
                $('#informacion_personal').show();
            });

            $('#next_informacion_profesional').on('click', function(){
                isWork = $('input[name=fsi_no_work]:checked').val()
                if (isWork == 'N'){
                    $('#informacion_profesional').hide();
                    $('#instituto_carrera').show();    
                }else{
                    var labora = $('#fLabora').val();
                    var name_empresa = $('#fnameEmpresa').val();
                    var actidad = $('#factividad').val();
                    var cargo = $('#fcargo').val();
                    var tiempo = $('#ftime').val();
                    var rango = $('#frango').val();
                    var relacion = $('#frelacion_cargo').val();
                    var fcargo_correcto = $('#fcargo_correcto').val();
                    var isError = false;

                    if(labora.length <=0 || labora == '--'){
                         $('#fLabora').addClass('is-invalid');
                         isError = true;
                    }else{
                        $('#fLabora').removeClass('is-invalid');
                    }

                    if(name_empresa.length <=0){
                         $('#fnameEmpresa').addClass('is-invalid');
                         isError = true;
                    }else{
                        $('#fnameEmpresa').removeClass('is-invalid');
                    }

                    if(actidad.length <=0){
                         $('#factividad').addClass('is-invalid');
                         isError = true;
                    }else{
                        $('#factividad').removeClass('is-invalid');
                    }

                    if(cargo.length <=0){
                         $('#fcargo').addClass('is-invalid');
                         isError = true;
                    }else{
                        $('#fcargo').removeClass('is-invalid');
                    }

                    if(tiempo.length <=0){
                         $('#ftime').addClass('is-invalid');
                         isError = true;
                    }else{
                        $('#ftime').removeClass('is-invalid');
                    }

                    if(rango.length <=0 || rango == '--'){
                         $('#frango').addClass('is-invalid');
                         isError = true;
                    }else{
                        $('#frango').removeClass('is-invalid');
                    }

                    if(relacion.length <=0 || relacion == '--'){
                         $('#frelacion_cargo').addClass('is-invalid');
                         isError = true;
                    }else{
                        $('#frelacion_cargo').removeClass('is-invalid');
                    }

                    if(fcargo_correcto.length <=0 || fcargo_correcto == '--'){
                         $('#fcargo_correcto').addClass('is-invalid');
                         isError = true;
                    }else{
                        $('#fcargo_correcto').removeClass('is-invalid');
                    }

                    if(!isError){
                         $('#informacion_profesional').hide();
                         $('#instituto_carrera').show();   
                    }
                }
                
            });

            $('#back_instituto_carrera').on('click', function(){
                $('#instituto_carrera').hide(); 
                $('#informacion_profesional').show();
            });

            $('#fdominio, #fact, #fmetodologia, #fhabilidades, #fevaluaciones').on('input', function(){
                this.value = this.value.replace(/[^0-9]/g,'');
            });

            $('#next_instituto_carrera').on('click', function(){
                var califica = $('#fcalifica').val();
                var why = $('#fporque').val()
                var fdominio = $('#fdominio').val();
                var fact = $('#fact').val();
                var fmetodologia = $('#fmetodologia').val();
                var fhabilidades = $('#fhabilidades').val();
                var fevaluaciones = $('#fevaluaciones').val();
                var ftalento = $('#ftalento').val();
                var finfra = $('#finfra').val();
                var fservicio = $('#fservicio').val();
                var fambTecno = $('#fambTecno').val();
                var fwork = $('#fwork').val();
                var fcomescri = $('#fcomescri').val();
                var fcomunicacion = $('#fcomunicacion').val();
                var finformatica = $('#finformatica').val();
                var fgestion = $('#fgestion').val();
                var finvestiga = $('#finvestiga').val();
                var fITSVR = $('#fITSVR').val();

                isError = false;

                if(fITSVR.length <= 0 || fITSVR == '--'){
                    $('#fITSVR').addClass('is-invalid');
                    isError = true;    
                }else{
                    $('#fITSVR').removeClass('is-invalid');
                }

                if(califica.length <= 0 || califica == '--'){
                    $('#fcalifica').addClass('is-invalid');
                    isError = true;    
                }else{
                    $('#fcalifica').removeClass('is-invalid');
                }

                if(why.length <= 0){
                    $('#fporque').addClass('is-invalid');
                    isError = true;    
                }else{
                    $('#fporque').removeClass('is-invalid');
                }

                if(fdominio.length <= 0 || (fdominio <= 0 || fdominio >5)){
                    $('#fdominio').addClass('is-invalid');
                    isError = true;    
                }else{
                    $('#fdominio').removeClass('is-invalid');
                }

                if(fact.length <= 0 || (fact <= 0 || fact >5)){
                    $('#fact').addClass('is-invalid');
                    isError = true;    
                }else{
                    $('#fact').removeClass('is-invalid');
                }

                if(fmetodologia.length <= 0 || (fmetodologia <= 0 || fmetodologia >5)){
                    $('#fmetodologia').addClass('is-invalid');
                    isError = true;    
                }else{
                    $('#fmetodologia').removeClass('is-invalid');
                }

                if(fhabilidades.length <= 0 || (fhabilidades <= 0 || fhabilidades >5)){
                    $('#fhabilidades').addClass('is-invalid');
                    isError = true;    
                }else{
                    $('#fhabilidades').removeClass('is-invalid');
                }

                if(fevaluaciones.length <= 0 || (fevaluaciones <= 0 || fevaluaciones >5)){
                    $('#fevaluaciones').addClass('is-invalid');
                    isError = true;    
                }else{
                    $('#fevaluaciones').removeClass('is-invalid');
                }

                if(!$('#finputPerso').prop('checked') && !$('#finputmateria').prop('checked') && !$('#finputcomuni').prop('checked') && !$('#finputExplique').prop('checked')){
                    Swal.fire({
                      type: 'info',
                      title: 'Oops...',
                      text: 'Seleccione uno de los conocimientos adquiridos en la carrera'
                    })
                }

                if($('#finputExplique').prop('checked')){
                    if($('#finputExplique_').val().length <=0){
                        $('#finputExplique_').addClass('is-invalid');
                        isError = true;      
                    }else{
                        $('#finputExplique_').removeClass('is-invalid');
                    }
                }

                if(ftalento.length <= 0 || (ftalento <= 0 || ftalento >5)){
                    $('#ftalento').addClass('is-invalid');
                    isError = true;    
                }else{
                    $('#ftalento').removeClass('is-invalid');
                }

                if(finfra.length <= 0 || (finfra <= 0 || finfra >5)){
                    $('#finfra').addClass('is-invalid');
                    isError = true;    
                }else{
                    $('#finfra').removeClass('is-invalid');
                }

                if(fservicio.length <= 0 || (fservicio <= 0 || fservicio >5)){
                    $('#fservicio').addClass('is-invalid');
                    isError = true;    
                }else{
                    $('#fservicio').removeClass('is-invalid');
                }

                if(fambTecno.length <= 0 || (fambTecno <= 0 || fambTecno >5)){
                    $('#fambTecno').addClass('is-invalid');
                    isError = true;    
                }else{
                    $('#fambTecno').removeClass('is-invalid');
                }

                

                if(fwork.length <= 0 || (fwork <= 0 || fwork >5)){
                    $('#fwork').addClass('is-invalid');
                    isError = true;    
                }else{
                    $('#fwork').removeClass('is-invalid');
                }

                if(fcomescri.length <= 0 || (fcomescri <= 0 || fcomescri >5)){
                    $('#fcomescri').addClass('is-invalid');
                    isError = true;    
                }else{
                    $('#fcomescri').removeClass('is-invalid');
                }

                if(fcomunicacion.length <= 0 || (fcomunicacion <= 0 || fcomunicacion >5)){
                    $('#fcomunicacion').addClass('is-invalid');
                    isError = true;    
                }else{
                    $('#fcomunicacion').removeClass('is-invalid');
                }

                if(finformatica.length <= 0 || (finformatica <= 0 || finformatica >5)){
                    $('#finformatica').addClass('is-invalid');
                    isError = true;    
                }else{
                    $('#finformatica').removeClass('is-invalid');
                }

                if(fgestion.length <= 0 || (fgestion <= 0 || fgestion >5)){
                    $('#fgestion').addClass('is-invalid');
                    isError = true;    
                }else{
                    $('#fgestion').removeClass('is-invalid');
                }

                if(finvestiga.length <= 0 || (finvestiga <= 0 || finvestiga >5)){
                    $('#finvestiga').addClass('is-invalid');
                    isError = true;    
                }else{
                    $('#finvestiga').removeClass('is-invalid');
                }

                if (!isError){
                    $('#instituto_carrera').hide(); 
                    $('#referencias_estudio').show();    
                }
                
            });

            $('#back_referencias_estudio').on('click', function(){
                $('#referencias_estudio').hide();
                $('#instituto_carrera').show(); 
            });


            $('#back_recomendaciones').on('click', function(){
                $('#referencias_estudio').show();
                $('#recomendaciones_sugerencias').hide();
            });

            $('#next_referencias_estudio').on('click', function(){
                var isError = false;
                var tema = $('#txt_temas').val();
                console.log(tema);

                if(tema.length <=0){
                    console.log('entro a error');
                    $('#txt_temas').addClass('is-invalid');
                    isError = true;
                }else{
                    $('#txt_temas').removeClass('is-invalid');
                }

                if(!isError){
                    $('#referencias_estudio').hide();
                    $('#recomendaciones_sugerencias').show();
                }
            });

            $('#save_recomendaciones').on('click', function(){
                var txt_recomen_temas = $('#txt_recomen_temas').val();
                var txt_recomen_asignatura = $('#txt_recomen_asignatura').val();
                var isError = false;

                if(txt_recomen_temas.length <=0){
                    $('#txt_recomen_temas').addClass('is-invalid');
                    isError = true;
                }else{
                    $('#txt_recomen_asignatura').removeClass('is-invalid')
                }

                if(txt_recomen_asignatura.length <= 0){
                    $('#txt_recomen_asignatura').addClass('is-invalid');
                    isError = true;
                }else{
                    $('#txt_recomen_asignatura').removeClass('is-invalid');
                }

                if(!isError){
                    //Logica JSON AJAX
                    Swal.fire({
                      title: 'Estas seguro?',
                      text: "No podrás revertir esto!",
                      type: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Deseas proceder!'
                    }).then((result) => {
                      if (result.value) {

                        var finputPerso = 0;
var finputmateria = 0;
var finputcomuni = 0;
var finputExplique = 0;

if($('#finputPerso').prop('checked')){
    finputPerso = 1;
} 

if($('#finputmateria').prop('checked')){
    finputmateria = 1;
}

if($('#finputcomuni').prop('checked')){
    finputcomuni = 1;
} 

if($('#finputExplique').prop('checked')){
    finputExplique = 1;
}

$.ajax({
    type: 'POST',
    url: '/encuesta/store',
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
    data: {
        "_token": $("meta[name='csrf-token']").attr("content"),
        'nombres' : $('#fcedula').val(),
        'apellidos': $('#fnombre').val(),
        'fecha_nacimiento': $('#fnacimiento').val(),
        'nacionalidad':  $('#fnacionalidad').val(),
        'genero': $('#fgenero').val(),
        'fecha_graduacion': $('#fgraduacion').val(),
        'carrera': $('#fcarrera').val(),
        'discapacidad': $('input[name=fsi_no_disc]:checked').val(),
        'carnet_conadis': $('#fncarnet').val(),
        'estado_civil': $('#fcivil').val(),
        'numero_hijos': $('#fnumhijos').val(),
        'pais': $('#fpais').val(),
        'ciudad': $('#fciudad').val(),
        'celular': $('#fcelular').val(),
        'convencional': $('#fconvencional').val(),
        'direccion': $('#fdireccion').val(),
        'correo': $('#fcorreo').val(),
        'etnia': $('#fetnia').val(),
        'trabajo_actual': $('input[name=fsi_no_work]:checked').val(),
        'tipo_institucion': $('#fLabora').val(),
        'empresa': $('#fnameEmpresa').val(),
        'actividad_empresa': $('#factividad').val(),
        'cargo': $('#fcargo').val(),
        'tiempo_laborando': $('#ftime').val(),
        'rango_sueldo': $('#frango').val(),
        'trabajo_exterior': $('input[name=fsi_no_ecuador]:checked').val(),
        'relacion_carrera_profesional': $('#frelacion_cargo').val(),
        'nivel_estudio_acorde': $('#fcargo_correcto').val(),
        'dificultad_para_trabajar': $('input[name=fsi_noempleo]:checked').val(),
        'formacion_profesional': $('#fcalifica').val(),
        'formación_profesional_porque': $('#fporque').val(),

        'calificacion_docente_dominio': $('#fdominio').val(),
        'calificacion_docente_actualizacion': $('#fact').val(),
        'calificacion_docente_metodologia': $('#fmetodologia').val(),
        'calificacion_docente_habilidades': $('#fhabilidades').val(),
        'calificacion_docente_evaluacion': $('#fevaluaciones').val(),

        'conocimientos_materias_profesionales': finputPerso,
        'conocimientos_materias_basicas': finputmateria,
        'conocimientos_comunicacion': finputcomuni,
        'conocimientos_otros': $('#finputExplique_').val(),
        'conocimientos_idiomas': finputExplique,
        
        'recursos_de_la_carrera_talento': $('#ftalento').val(),
        'recursos_de_la_carrera_infraestructura': $('#finfra').val(),
        'recursos_de_la_carrera_servicio': $('#fservicio').val(),
        'recursos_de_la_carrera_ambiente': $('#fambTecno').val(),
        
        'dificultad_general_trabajo_equipo': $('#fwork').val(),
        'dificultad_general_comunicacion_escrita': $('#fcomescri').val(),
        'dificultad_general_comunicacion_oral': $('#fcomunicacion').val(),
        'dificultad_general_informatica': $('#finformatica').val(),
        'dificultad_general_gestion': $('#fgestion').val(),
        'dificultad_general_investigacion': $('#finvestiga').val(),
        
        'relacion_desempeño_descripcion': $('#fITSVR').val(),
        'estudios_pregrado': $('input[name=fsi_no_pregrado]:checked').val(),
        'otra_carrera' : $('input[name=fsi_no_ITSVR]:checked').val(),
        'recomendar_institucion': $('input[name=fsi_no_recomendacion]:checked').val(),
        'temas_interes_r1': $('#txt_temas').val(),
        'txt_recomen_temas': $('#temas_incluir1').val(),
        'txt_recomen_asignatura': $('#asignatura1').val(),
        'token' : @json($token)

    },
    success: function(returnData){
        console.log(returnData);
    
        console.log(returnData);
        const toast = swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1500
        });
        toast({
            type: 'success',
            title: 'Se realizo correctamente'
        })

        setTimeout(function() {
            $(location).attr('href','/');  
        },1000);

    },
    error: function(respuesta){
        console.log(respuesta);
        swal({
          type: 'error',
          title: 'ERROR INTERNO',
          text: 'Error de conexión',
        })
    }
});
                        

                      }
                    })
                }
            });

        });

        
        </script>
    </body>
</html>