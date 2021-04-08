<?php

namespace App\Validators;
use Illuminate\Support\Facades\Validator;

use App\Entities as Entities;

/**
 * Valida se ativo possui algum embarcado
 * @param asset_id
 */
class BoardedValidator extends Validator {

    function validate($attribute, $value, $parameters, $validator) {

        return Entities\Device::where("asset_id",$value)->count() > 0;

    }
}
