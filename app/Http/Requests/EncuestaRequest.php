<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EncuestaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            /* Datos personales */
           'identificacion' => 'required |String',
           'tipo_identificacion' => 'required |Numeric',
           'nombres' => 'required |String',
           'apeliidos' => 'required |String',
           'fecha_nacimiento' => 'required | date',
           'nacionalidad' => 'required |Numeric',
           'genero' => 'required |Numeric',
           'fecha_graduacion' => 'required | date',
           'carrera' => 'required |Numeric',
           'discapidad' => 'required |String',
           'carnet_conadis' => 'required_if:discapacidad,si',
            /* informacion personal */
           'estado_civil' => 'required |Numeric',
           'numero_hijos' => 'required |String',
           'pais' => 'required |Numeric',
           'ciudad' => 'required |Numeric',
           'celular' => 'required |String',
           'convencional' => 'required |String',
           'direccion' => 'required |String',
           'correo' => 'required | email',
           'etnia' => 'required |Numeric',
           /* informacion profesional */
           'trabajo_actual' => 'required | String',
           'tipo_institucion' => 'required | Numeric',
           'empresa' => 'required |String',
           'actividad_empresa' => 'required |Numeric',
           'cargo' => 'required |Numeric',
           'tiempo_laborando' => 'required |Numeric',
           'tipo_contrato' => 'required |Numeric',
           'rango_sueldo' => 'required |Numeric',
           'trabajo_exterior' => 'required |string',
           'relacion_carrera_profesional' => 'required |Numeric',
           'nivel_estudio_acorde' => 'required |Numeric',
           'dificultad_para_trabajar' => 'required |String',
            /* instituto Carrera recurso */
           'formacion_profesional' => 'required | String',
           'formación_profesional_porque' => 'required | String',

           'calificacion_docente_dominio' => 'required | String' ,
            'calificacion_docente_actualizacion' => 'required | String' ,
            'calificacion_docente_metodologia' => 'required | String' ,
            'calificacion_docente_habilidades' => 'required | String' ,
            'calificacion_docente_evaluacion' => 'required | String' ,

            'conocimientos_materias_profesionales' => 'required | Numeric',
            'conocimientos_materias_basicas' => 'required | Numeric',
            'conocimientos_comunicacion' => 'required | Numeric',
            'conocimientos_otros' => 'required | Numeric',
            'conocimientos_idiomas' => 'required | Numeric',

            //'conocimientos_menos_utiles_explique' => 'required_if : conocimientos_menos_utiles, 4 | String',

           'recursos_de_la_carrera_talento' => 'required | String',
           'recursos_de_la_carrera_infraestructura' => 'required | String',
           'recursos_de_la_carrera_servicio' => 'required | String',
           'recursos_de_la_carrera_ambiente' => 'required | String',


            'dificultad_general_trabajo_equipo' => 'required | String ',
            'dificultad_general_comunicacion_escrita' => 'required | String ',
            'dificultad_general_comunicacion_oral' => 'required | String ',
            'dificultad_general_informatica' => 'required | String ',
            'dificultad_general_gestion' => 'required | String ',
            'edificultad_general_investigacion' => 'required | String ',


           'relacion_desempeño_descripcion' => 'required |Numeric',

           'estudios_pregrado' => 'required | string',
           'otra_carrera' => 'required | string',
           'recomendar_institucion' => 'required | string',

           'temas_interes_r1' => 'required | String',
           'temas_interes_r2' => 'required | String',

           'temas_incluir1' => 'required | String',
           'temas_incluir2' => 'required | String',
           'temas_incluir3' => 'required | String',

           'asignatura' => 'required | array',
        ];
    }

    public function messages() {
        return [

        ];
    }
}
