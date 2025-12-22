<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'display_name' => ['required', 'string', 'max:50'],
            'username' => ['required', 'string', 'max:15', 'unique:users'],
            'email' => ['required', 'string', 'email', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed']
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Este campo es obligatorio',
            'string' => 'Has introducido datos no válidos',
            'display_name.max' => 'Máximo 50 caracteres',
            'username.max' => 'Máximo 15 caracteres',
            'username.unique' => 'Este nombre de usuario ya esta en uso',
            'email.email' => 'Introduce un correo electrónico válido',
            'email.unique' => 'Este correo electrónico ya esta en uso',
            'password.min' => 'Mínimo 6 caracteres'
        ];
    }
}
