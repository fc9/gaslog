<?php
namespace App\Validators;
use Illuminate\Support\Facades\Validator;

class RequiredCheckboxValidator extends Validator {

    function validate($attribute, $value, $parameters, $validator) {
        return $value === "";
    }

}
