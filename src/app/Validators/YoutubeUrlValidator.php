<?php
namespace App\Validators;
use Illuminate\Support\Facades\Validator;

class YoutubeUrlValidator extends Validator {

    //const PATTERN = '~^(?:https?://)?(?:www[.])?(?:youtube[.]com/watch[?]v=|youtu[.]be/)([^&]{11})~x';
    const PATTERN = '~^(?:https?://)?(?:www[.])?(?:youtube[.]com|youtu[.]be/)~x';

    function validate($attribute, $value, $parameters, $validator) {
        return (boolean) preg_match(static::PATTERN, $value);
    }

}
