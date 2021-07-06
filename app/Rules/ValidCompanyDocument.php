<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidCompanyDocument implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $company_document = preg_replace('/[^0-9]/', '', (string) $value);
	
        // Valida tamanho
        if (strlen($company_document) != 14) {
            return false;
        }

        // Verifica se todos os digitos são iguais
        if (preg_match('/(\d)\1{13}/', $company_document)) {
            return false;	
        }

        // Valida primeiro dígito verificador
        for ($i = 0, $j = 5, $sum = 0; $i < 12; $i++) {
            $sum += $company_document[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        $mod = $sum % 11;

        if ($company_document[12] != ($mod < 2 ? 0 : 11 - $mod))
            return false;

        // Valida segundo dígito verificador
        for ($i = 0, $j = 6, $sum = 0; $i < 13; $i++)
        {
            $sum += $company_document[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        $mod = $sum % 11;

        return $company_document[13] == ($mod < 2 ? 0 : 11 - $mod);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'O :attribute informado não é um :attribute válido';
    }
}
