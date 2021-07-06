<?php

namespace App\Http\Requests\User;

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
            'first_name' => [ 'string' ],
            'last_name' => [ 'string' ]
        ];
    }

    public function attributes()
    {
        return [
            'first_name' => 'nome',
            'last_name' => 'sobrenome'
        ];
    }

    public function messages()
    {
        return [
            'first_name.string' => 'Campo :attribute não é uma palavra',
            'last_name.string' => 'Campo :attribute não é uma palavra'
        ];
    }
}
