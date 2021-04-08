<?php
namespace App\Validators;
use Illuminate\Support\Facades\Validator;

class CnpjValidator extends Validator {

    function validate($attribute, $value, $parameters, $validator) {
        if(empty($value)) {
            return false;
        }

        $value = str_pad(preg_replace('/[^0-9]/', '', (string) $value), 14, '0', STR_PAD_LEFT);

        // Valida primeiro dígito verificador
        for ($i = 0, $j = 5, $sum = 0; $i < 12; $i++) {
            $sum += $value{$i} * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        $rest = $sum % 11;
        if ($value{12} != ($rest < 2 ? 0 : 11 - $rest)) {
            return false;
        }

        // Valida segundo dígito verificador
        for ($i = 0, $j = 6, $sum = 0; $i < 13; $i++) {
            $sum += $value{$i} * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        $rest = $sum % 11;

        return $value{13} == ($rest < 2 ? 0 : 11 - $rest);
    }

}
