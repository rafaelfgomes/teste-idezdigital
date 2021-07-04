<?php

namespace App\Http\Requests\User;

use App\Rules\ValidDocument;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'unique:users,email' ],
            'document' => ['required', 'string', 'unique:users,document', new ValidDocument()],
            'password' => [ 'required', 'string', 'min:6']
        ];
    }

    public function attributes()
    {
        return [
            'first_name' => 'nome',
            'last_name' => 'sobrenome',
            'email' => 'e-mail',
            'document' => 'CPF',
            'password' => 'senha'
        ];
    }

    public function messages()
    {
        $required = [
            'first_name.required' => 'Campo :attribute é obrigatório',
            'last_name.required' => 'Campo :attribute é obrigatório',
            'email.required' => 'Campo :attribute é obrigatório',
            'document.required' => 'Campo :attribute é obrigatório',
            'password.required' => 'Campo :attribute é obrigatório'
        ];

        $string = [
            'first_name.string' => 'Campo :attribute não é uma palavra',
            'last_name.string' => 'Campo :attribute não é uma palavra',
            'email.string' => 'Campo :attribute não é uma palavra',
            'document.string' => 'Campo :attribute não é uma palavra',
            'password.string' => 'Campo :attribute não é uma palavra'
        ];

        $emailValid = [
            'email.email' => ':email não é um e-mail válido',
            'email.unique' => 'Já existe um e-mail \':input\' cadastrado'
        ];

        $documentValid = [
            'document.unique' => 'Já existe um :attribute \':input\' cadastrado'
        ];

        $passwordValid = [
            'password.min' => 'A senha deve ter no mínimo :min caracteres'
        ];

        return array_merge($required, $string, $emailValid, $documentValid, $passwordValid);
    }
}
