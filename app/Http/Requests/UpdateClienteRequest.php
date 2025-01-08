<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClienteRequest extends FormRequest
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
        ];
    }

    public function messages()
    {
        return [
            'firstname.required' => "El Primer Nombre es obligatorio.",
            'lastname.required' => "El Primer Apellido es obligatorio.",
            'birthdate.required' => "La Fecha de Nacimiento es obligatoria.",
            'phone.required' => "El Telefono es obligatorio.",
        ];
    }
}
