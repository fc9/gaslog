<?php
namespace App\Validators;
use Illuminate\Support\Facades\Validator;

class CpfFormatValidator extends Validator {

    const PATTERN = '/^[0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}$/';

    function validate($attribute, $value, $parameters, $validator) {
        return (boolean) preg_match(static::PATTERN, $value);
    }

}
