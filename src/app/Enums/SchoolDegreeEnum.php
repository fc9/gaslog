<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class SchoolDegreeEnum extends Enum implements LocalizedEnum
{
    //const Infantil = 1;
    const ANO_1_FUNDAMENTAL = 2;
    const ANO_2_FUNDAMENTAL = 3;
    const ANO_3_FUNDAMENTAL = 4;
    const ANO_4_FUNDAMENTAL = 5;
    const ANO_5_FUNDAMENTAL = 6;
    const ANO_6_FUNDAMENTAL = 7;
    const ANO_7_FUNDAMENTAL = 8;
    const ANO_8_FUNDAMENTAL = 9;
    const ANO_9_FUNDAMENTAL = 10;
    const ANO_1_MEDIO = 11;
    const ANO_2_MEDIO = 12;
    const ANO_3_MEDIO = 13;
}
