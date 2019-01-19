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
           'formacion_profesional' => 'required | Numeric',
           'formación_profesional_porque' => 'required | String',
           'calificacion_docente' => 'required | String' ,
           'conocimientos_menos_utiles' => 'required | Numeric',
           'conocimientos_menos_utiles_explique' => 'required_if : conocimientos_menos_utiles, 4 | String',
           'recursos_de_la_carrera' => 'required | array',
           'dificultad_general' => 'required | array ',
           'relacion_desempeño' => 'required |Numeric',
           'estudios_pregrado' => 'required | string',
           'otra_carrera' => 'required | string',
           'recomendar_institucion' => 'required | string',
           'temas_interes' => 'required | array',
           'temas' => 'required | array',
           'asignatura' => 'required | array',
        ];
    }

    public function messages() {
        return [

        ];
    }
}
