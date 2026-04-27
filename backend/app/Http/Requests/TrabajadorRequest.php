<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

class TrabajadorRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'nombre' => 'required|string|max:255',
            'cargo_id' => 'required|integer|exists:cargos,id',
            'proyecto_id' => 'required|integer|exists:proyectos,id'
        ];
    }
    
    public function messages()
    {
        return [
            'nombre.required' => 'Debe de ingresar en nombre',
            'nombre.max' => 'El nombre no puede tener más de 255 caracteres',
            'cargo_id.required'  => 'Debe seleccionar un cargo',
            'proyecto_id.required' => 'Debe seleccionar un proyecto'
        ];
    }
    

}