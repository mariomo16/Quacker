<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'username' => ['required', 'string', 'max:15', Rule::unique('users', 'username')->ignore($this->route('user')->id)],
            'display_name' => 'required|string|max:50',
            'email' => ['required', 'string', 'email', Rule::unique('users', 'username')->ignore($this->route('user')->email)],
            'password' => 'nullable|string|min:6',
        ];
    }

    public function messsages(): array
    {
        return [
            'required' => 'Este campo es obligatorio',
            'string' => 'Has introducido datos no válidos',
            'username.max' => 'Máximo 15 caracteres',
            'username.unique' => 'Este nombre de usuario ya esta en uso',
            'display_name.max' => 'Máximo 50 caracteres',
            'email.email' => 'Introduce un correo electrónico válido',
            'email.unique' => 'Este correo electrónico ya esta en uso',
        ];
    }
}
