<?php

namespace App\Http\Requests\Transaction;

use App\Rules\ValidAccount;
use App\Rules\ValidTransactionType;
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
            'value' => [ 'required', 'numeric', 'min:0.01' ],
            'type' => [ 'required', 'numeric', new ValidTransactionType() ],
            'account' => [ 'required', 'numeric', new ValidAccount() ]
        ];
    }

    public function attributes()
    {
        return [
            'value' => 'valor',
            'type' => 'tipo da transação',
            'account' => 'conta',
        ];
    }

    public function messages()
    {
        $required = [
            'value.required' => 'Campo :attribute é obrigatório',
            'type.required' => 'Campo :attribute é obrigatório',
            'account.required' => 'Campo :attribute é obrigatório'
        ];

        $numeric = [
            'value.numeric' => 'Campo :attribute deve ser numérico',
            'type.numeric' => 'Campo :attribute deve ser numérico',
            'account.numeric' => 'Campo :attribute deve ser numérico',
        ];

        $validValue = [
            'value.min' => 'O :attribute deve ser acima de :min'
        ];

        return array_merge($required, $numeric, $validValue);
    }
}
