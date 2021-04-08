<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class UserType extends Enum
{
    const USER = 1;
    const ADMINISTRATOR = 2;
    const APPRAISER = 3;
    const ROOT = 4;

    public static function getDescription($value): string
    {
        switch ($value){
            case self::USER:
                return "Usuário";
            case self::ADMINISTRATOR:
                return "Administrador";
            case self::APPRAISER:
                return "Avaliador";
            case self::ROOT:
                return "ROOT";
            break;
        }

        return parent::getDescription($value);
    }
}
