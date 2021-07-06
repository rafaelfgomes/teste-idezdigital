<?php

namespace App\Http\Requests\Account;

use App\Helpers\DocumentHelper;
use App\Rules\ValidAccountUser;
use App\Rules\ValidCompanyDocument;
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

        if (!empty($requestData['company'])) {
            $requestData['company']['company_document'] = DocumentHelper::sanitizeDocument($requestData['company']['company_document']);
        }

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
            'agency' => [ 'required', 'string' ],
            'number' => [ 'required', 'string' ],
            'digit' => [ 'required', 'string', 'max:1' ],
            'type' => [ 'required', 'numeric' ],
            'user' => [ 'required', 'email', new ValidAccountUser() ]
        ];

        if (!empty($this->request->get('company'))) {
            $companyRules = [
                'company.company_name' => [ 'required', 'string' ],
                'company.fantasy_name' => [ 'required', 'string' ],
                'company.company_document' => [ 'required', 'string', 'unique:company_accounts_data,company_document', new ValidCompanyDocument() ],
            ];

            $rules = array_merge($rules, $companyRules);
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'agency' => 'agência',
            'number' => 'número da conta',
            'digit' => 'dígito',
            'type' => 'tipo da conta',
            'user' => 'usuário',
            'company.company_name' => 'nome da empresa',
            'company.fantasy_name' => 'nome fantasia',
            'company.company_document' => 'CNPJ'
        ];
    }

    public function messages()
    {
        $required = [
            'agency.required' => 'Campo :attribute é obrigatório',
            'number.required' => 'Campo :attribute é obrigatório',
            'digit.required' => 'Campo :attribute é obrigatório',
            'type.required' => 'Campo :attribute é obrigatório',
            'user.required' => 'Campo :attribute é obrigatório'
        ];

        $string = [
            'agency.string' => 'Campo :attribute não é uma palavra',
            'number.string' => 'Campo :attribute não é uma palavra',
            'digit.string' => 'Campo :attribute não é uma palavra'
        ];

        $emailValid = [
            'user.email' => '\':input\' não é um e-mail válido',
        ];

        $numeric = [
            'type.numeric' => 'Campo :attribute deve ser numérico',
        ];

        $digitValid = [
            'digit.max' => 'O dígito da conta deve conter somente 1 caractere'
        ];

        $messages = array_merge($required, $string, $emailValid, $numeric, $digitValid);

        if (!empty($this->request->get('company'))) {
            $companyRequired = [
                'company.company_name.required' => 'Campo :attribute é obrigatório',
                'company.fantasy_name.required' => 'Campo :attribute é obrigatório',
                'company.company_document.required' => 'Campo :attribute é obrigatório',
            ];

            $companyString = [
                'company.company_name.string' => 'Campo :attribute não é uma palavra',
                'company.fantasy_name.string' => 'Campo :attribute não é uma palavra',
                'company.company_document.string' => 'Campo :attribute não é uma palavra',
            ];

            $companyDocumentValid = [
                'company.company_document.unique' => ':attribute já cadastrado'
            ];

            $messages = array_merge($messages, $companyRequired, $companyString, $companyDocumentValid);
        }

        return $messages;
    }
}
