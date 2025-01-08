<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJuzgadoRequest extends FormRequest
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
            'name' => ['required', 'unique:juzgados,name, null,'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El campo Nombre de Juzgado es obligatorio',
            'name.unique' => 'El Nombre de Juzgado ya se encuentra registrado',
        ];
    }
}
