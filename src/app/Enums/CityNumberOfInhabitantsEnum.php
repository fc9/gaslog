<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class CityNumberOfInhabitantsEnum extends Enum implements LocalizedEnum
{
    const Max_10000 = 1;
    const Between_10000_and_25000 = 2;
    const Between_25000_and_50000 = 3;
    const Between_50000_and_200000 = 4;
    const Between_200000_and_500000 = 5;
    const Min_500000 = 6;

//    public static function getDescription($value): string
//    {
//        switch ($value){
//            case self::COUNT1:
//                return "Até 10.000 habitantes";
//            case self::COUNT2:
//                return "Entre 10.000 e 25.000 habitantes";
//            case self::COUNT3:
//                return "Entre 25.000 e 50.000 habitantes";
//            case self::COUNT4:
//                return "Entre 50.000 e 200.000 habitantes";
//            break;
//            case self::COUNT5:
//                return "Entre 200.000 e 500.000 habitantes";
//            break;
//            case self::COUNT6:
//                return "Mais de 500.000 habitantes";
//            break;
//        }
//
//        return parent::getDescription($value);
//    }
}
