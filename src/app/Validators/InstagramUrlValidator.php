<?php
namespace App\Validators;
use Illuminate\Support\Facades\Validator;

class InstagramUrlValidator extends Validator {

    const PATTERN = '~^(?:https?://)?(?:.*)?(?:instagram[.]com.*)~x';

    function validate($attribute, $value, $parameters, $validator) {
        return (boolean) preg_match(static::PATTERN, $value);
    }

}
