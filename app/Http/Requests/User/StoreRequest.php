<?php

namespace App\Http\Requests\User;

use App\Helpers\DocumentHelper;
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

    public function all($keys = null)
    {
        $requestData = $this->request->all();

        $requestData['document'] = DocumentHelper::sanitizeDocument($requestData['document']);
        
        return $requestData;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'first_name' => [ 'required', 'string' ],
            'last_name' => [ 'required', 'string' ],
            'email' => [ 'required', 'string', 'email', 'unique:users,email' ],
            'document' => [ 'required', 'string', 'unique:users,document', new ValidDocument() ],
            'password' => [ 'required', 'string', 'min:6' ]
        ];

        if (!empty($this->request->get('contacts'))) {
            $contactRules = [
                'contacts.*.code' => [ 'required', 'string', 'size:2' ],
                'contacts.*.number' => [ 'required', 'string', 'min:8', 'max:9' ]
            ];

            $rules = array_merge($rules, $contactRules);
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'first_name' => 'nome',
            'last_name' => 'sobrenome',
            'email' => 'e-mail',
            'document' => 'CPF',
            'password' => 'senha',
            'contacts.*.code' => 'DDD',
            'contacts.*.number' => 'número de contato',
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
            'email.email' => '\':input\' não é um e-mail válido',
            'email.unique' => 'Já existe um e-mail \':input\' cadastrado'
        ];

        $documentValid = [
            'document.unique' => ':attribute já cadastrado'
        ];

        $passwordValid = [
            'password.min' => 'A senha deve ter no mínimo :min caracteres'
        ];

        $messages = array_merge($required, $string, $emailValid, $documentValid, $passwordValid);

        if (!empty($this->request->get('contacts'))) {
            $contactRequired = [
                'contacts.*.code.required' => 'Campo :attribute é obrigatório',
                'contacts.*.number.required' => 'Campo :attribute é obrigatório',
            ];

            $contactString = [
                'contacts.*.code.string' => 'Campo :attribute é obrigatório',
                'contacts.*.number.string' => 'Campo :attribute é obrigatório'
            ];

            $contactCodeValid = [
                'contacts.*.code.size' => ':attribute inválido',
            ];

            $contactNumberValid = [
                'contacts.*.number.min' => ':attribute precisa ter mais de :min números',
                'contacts.*.number.max' => ':attribute precisa ter no máximo :max números',
            ];

            $messages = array_merge($messages, $contactRequired, $contactString, $contactCodeValid, $contactNumberValid);
        }

        return $messages;
    }
}
