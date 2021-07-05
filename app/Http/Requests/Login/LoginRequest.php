<?php

namespace App\Http\Requests\Login;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => [ 'required', 'string', 'email' ],
            'password' => [ 'required', 'string', 'min:6' ]
        ];
    }

    public function attributes()
    {
        return [
            'email' => 'e-mail',
            'password' => 'senha'
        ];
    }

    public function messages()
    {
        $required = [
            'email.required' => 'Campo :attribute é obrigatório',
            'password.required' => 'Campo :attribute é obrigatório'
        ];

        $string = [
            'email.string' => 'Campo :attribute não é uma palavra',
            'password.string' => 'Campo :attribute não é uma palavra'
        ];

        $emailValid = [
            'email.email' => ':email não é um e-mail válido'
        ];

        $passwordValid = [
            'password.min' => 'A senha deve ter no mínimo :min caracteres'
        ];

        return array_merge($required, $string, $emailValid, $passwordValid);
    }
}
