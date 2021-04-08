<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class UserStatus extends Enum
{
    const ACTIVE = 1;
    const INACTIVE = 2;

    public static function getDescription($value): string
    {
        if ($value === self::ACTIVE) {
            return 'Ativo';
        } elseif ($value === self::INACTIVE) {
            return 'Inativo';
        }

        return parent::getDescription($value);
    }
}
