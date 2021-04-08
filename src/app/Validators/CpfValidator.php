<?php
namespace App\Validators;
use Illuminate\Support\Facades\Validator;

class CpfValidator extends Validator {

    function validate($attribute, $value, $parameters, $validator) {
        if(empty($value)) {
            return false;
        }

        $value = str_pad(preg_replace('/[^0-9]/', '', (string) $value), 11, '0', STR_PAD_LEFT);

        $invalidValues = [
            '00000000000', '11111111111', '22222222222', '33333333333',
            '44444444444', '55555555555', '66666666666', '77777777777',
            '88888888888', '99999999999'
        ];
        if (strlen($value) != 11 || in_array($value, $invalidValues)) {
            return false;
        }

        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $value{$c} * (($t + 1) - $c);
            }

            $d = ((10 * $d) % 11) % 10;

            if ($value{$c} != $d) {
                return false;
            }
        }

        return true;
    }

}
