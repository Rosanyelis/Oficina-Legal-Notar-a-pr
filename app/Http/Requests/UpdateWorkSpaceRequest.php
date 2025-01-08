<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWorkSpaceRequest extends FormRequest
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
            'title' => 'required',
            'client_id' => 'required|exists:clients,id',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'El nombre del espacio de trabajo es requerido',
            'client_id.*' => 'El cliente es requerido',
        ];
    }
}
