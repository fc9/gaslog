<?php

namespace App\Enums;

use BenSampo\Enum\Enum;


final class ActionOption extends Enum
{
    const NO = 1;
    const PROJECTNOTFINISHED = 2;
    const PROTOTYPEONLY = 3;
    const WEAK = 4;
    const MEDIUM = 5;
    const GOOD = 6;
    const SPOTLIGHT = 7;
    const NOINFORMATION = 8;

    public static function getDescription($value): string
    {
        switch ($value){
            case self::NO   :
                return "Não houve";
            case self::PROJECTNOTFINISHED:
                return "Projeto não finalizado";
            case self::PROTOTYPEONLY:
                return "Apenas protótipo";
            case self::WEAK:
                return "Fraco";
            case self::MEDIUM:
                return "Médio";
            case self::GOOD:
                return "Bom";
            case self::SPOTLIGHT:
                return "Destaque";
            case self::NOINFORMATION:
                    return "Não há informações";
            default:
                return "Desconhecido";
        }

        return parent::getDescription($value);
    }
}
