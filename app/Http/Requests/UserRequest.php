<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        
        $user = $this->route('user');

        return [
            'name' => 'required_if:name,!=,null',
            'email' => 'required_if:email,!=,null|email|unique:users,email,' . ($user ? $user->id : null),
            'password' => 'required_if:password,!=,null|min:6',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required_if' => 'Campo Nome é obrigatório.',
            'email.required_if' => 'Campo E-Mail é obrigatório.',
            'email.email' => 'Campo Email não é válido.',
            'email.unique' => 'Este Email já está cadastrado.',
            'password.required_if' => 'Campo senha é obrigatório.',
            'password.min' => 'A senha deve conter no mínimo :min caracteres.',
        ];
    }
}
