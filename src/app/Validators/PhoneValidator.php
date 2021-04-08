<?php
namespace App\Validators;
use Illuminate\Support\Facades\Validator;

class PhoneValidator extends Validator {

    const PATTERN = '/^\([0-9]{2}\) [0-9]{4,5}-[0-9]{4}$/';

    function validate($attribute, $value, $parameters, $validator) {
        return (boolean) preg_match(static::PATTERN, $value);
    }

}
