<?php
namespace App\Validators;
use Illuminate\Support\Facades\Validator;

class FacebookUrlValidator extends Validator {

    const PATTERN = '~^(?:https?://)?(?:.*)?(?:facebook[.]com.*)~x';

    function validate($attribute, $value, $parameters, $validator) {
        return (boolean) preg_match(static::PATTERN, $value);
    }

}
