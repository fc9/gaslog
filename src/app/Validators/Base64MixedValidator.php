<?php
namespace App\Validators;
use Illuminate\Support\Facades\Validator;

use Modules\Core\Libraries\Base64File;

class Base64MixedValidator extends Validator {

    const ALLOWED_MIME_TYPES = [
        'application/pdf',
        'application/vnd.ms-powerpoint',
        'application/msword',
        //'text/csv',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'application/vnd.oasis.opendocument.presentation',
        //'application/vnd.oasis.opendocument.spreadsheet',
        //'application/vnd.oasis.opendocument.text',
        'application/vnd.openxmlformats-officedocument.presentationml.presentation',
        //'application/rtf',
        //'text/plain',
        //'application/vnd.visio',
        //'application/vnd.ms-excel',
        //'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
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
