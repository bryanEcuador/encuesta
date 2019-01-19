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
           'nombres' => 'required |String',
           'fecha_nacimiento' => 'required | date',
           'nacionalidad' => 'required |String',
           'genero' => 'required |String',
           'fecha_graduacion' => 'required | date',
           'carrera' => 'required |String',
           'discapidad' => 'required |String',
           'carnet_conadis' => 'required_if:discapacidad,si',
            /* informacion personal */
           'estado_civil' => 'required |String',
           'numero_hijos' => 'required |String',
           'pais' => 'required |String',
           'ciudad' => 'required |String',
           'celular' => 'required |String',
           'convencional' => 'required |String',
           'direccion' => 'required |String',
           'correo' => 'required | email',
           'etnia' => 'required |String',
           /* informacion profesional */
           'empresa' => 'required |String',
           'cargo' => 'required |String',
           'tiempo_laborando' => 'required |String',
           'tipo_contrato' => 'required |string',
           'trabajo_exterior' => 'required |string',
           'relacion_carrera_profesional' => 'required |String',
           'nivel_estudio_acorde' => 'required |String',
           'dificultad_para_trabajar' => 'required |String',
            /* instituto Carrera recurso */
           'formacion_profesional' => 'required | string',
           'calificacion_docente' => 'required | array' ,
           'conocimientos_menos_utiles' => 'required | array',
           'recursos_de_la_carrera' => 'required | array',
           'dificultad_general' => 'required | array ',
           'relacion_desempeño' => 'required |string',
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
