<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'firstname' => ['required'],
            'lastname' => ['required'],
            'birthdate' => ['required'],
            'phone' => ['required'],
            'medio_contactos_id' => ['required'],
            'materia_id' => ['required'],
            'juzgado_id' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'firstname.required' => "El Primer Nombre es obligatorio.",
            'lastname.required' => "El Primer Apellido es obligatorio.",
            'birthdate.required' => "La Fecha de Nacimiento es obligatoria.",
            'phone.required' => "El Teléfono es obligatorio.",
            'medio_contactos_id.required' => "El Medio de Contacto es obligatorio.",
            'materia_id.required' => "La Materia es obligatoria.",
            'juzgado_id.required' => "El Juzgado es obligatorio.",
        ];

    }
}
