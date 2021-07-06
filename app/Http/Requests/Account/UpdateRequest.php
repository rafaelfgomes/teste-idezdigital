<?php

namespace App\Http\Requests\Account;

use App\Helpers\DocumentHelper;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'agency' => [ 'required', 'string' ],
            'number' => [ 'required', 'string' ],
            'digit' => [ 'required', 'string', 'max:1' ]
        ];
    }

    public function attributes()
    {
        return [
            'agency' => 'agência',
            'number' => 'número da conta',
            'digit' => 'dígito'
        ];
    }

    public function messages()
    {
        $required = [
            'agency.required' => 'Campo :attribute é obrigatório',
            'number.required' => 'Campo :attribute é obrigatório',
            'digit.required' => 'Campo :attribute é obrigatório',
        ];

        $string = [
            'agency.string' => 'Campo :attribute não é uma palavra',
            'number.string' => 'Campo :attribute não é uma palavra',
            'digit.string' => 'Campo :attribute não é uma palavra'
        ];

        $digitValid = [
            'digit.max' => 'O dígito da conta deve conter somente 1 caractere'
        ];

        $messages = array_merge($required, $string, $digitValid);

        return $messages;
    }
}
