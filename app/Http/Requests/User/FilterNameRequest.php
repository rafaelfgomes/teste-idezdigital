<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class FilterNameRequest extends FormRequest
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
            'name' => ['required', 'string']
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nome'
        ];
    }

    public function messages()
    {
        $required = [
            'name.required' => 'Parâmetro :attribute é obrigatório'
        ];

        $string = [
            'name.string' => 'Campo :attribute não é uma palavra',
        ];

        return array_merge($required, $string);
    }
}
