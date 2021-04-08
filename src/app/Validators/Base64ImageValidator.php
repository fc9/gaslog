<?php
namespace App\Validators;
use Illuminate\Support\Facades\Validator;

use Modules\Core\Libraries\Base64File;

class Base64ImageValidator extends Validator {

    const ALLOWED_MIME_TYPES = [
        'image/jpeg',
        //'image/png',
        //'image/bmp',
        //'image/svg+xml',
    ];

    function validate($attribute, $value, $parameters, $validator) {
        $file = new Base64File($value);
        $mimetype = $file->getMimeType();

        return in_array($mimetype, static::ALLOWED_MIME_TYPES);
    }

}
