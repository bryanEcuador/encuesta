<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoles extends FormRequest
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
            'slug' => 'required|max:30|unique:roles|string|regex:/^[a-zA-ZáéíóúÁÉÍÓÚÑñ]+$/i',
            'name' => 'required|max:30|unique:roles|string|regex:/^[a-zA-ZáéíóúÁÉÍÓÚÑñ.]+$/i',
            'description' => 'required|max:100|string|regex:/^[a-zA-ZáéíóúÁÉÍÓÚÑñ\s]+$/i',
            'special' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'slug.required' => 'El slug es requerido',
            'slug.max' => 'El slug solo puede tener un maximo de 30 caracteres',
            'slug.unique' => "El nombre del slug debe ser unico",
            'slug.regex' => "El formato del slug no es valido",

            'name.required' => 'El nombre es requerido',
            'name.max' => 'El nombre solo puede tener un maximo de 25 caracteres',
            'name.unique' => "El nombre  debe ser unico",
            'name.regex' => "El formato del nombre no es valido",

            'description.required' => 'La descripción es requerida',
            'description.max' => 'La descripción solo puede tener un maximo de 50 caracteres',
            'description.regex' => "El formato de la descripción no es valido",

            'special.required' => 'Debe seleccionar el tipo de permiso con el que cuenta el rol', 
        ];
    }
}
