<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
            'rol' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El campo Nombre de Usuario es requerido',
            'email.required' => 'El campo Correo Electrónico es requerido',
            'email.email' => 'El campo Correo Electrónico no es valido',
            'password.required' => 'El campo Contraseña es requerido',
            'rol.required' => 'El campo Rol es requerido',
        ];
    }
}
