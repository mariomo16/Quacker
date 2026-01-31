<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class QuashtagRequest extends FormRequest
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
            'name' => ['required', 'string', Rule::unique('quashtags', 'name')->ignore($this->route('quashtag')?->id)],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Este campo es obligatorio',
            'string' => 'Has introducido datos no válidos',
            'name.unique' => 'Este quashtag ya existe',
        ];
    }
}
