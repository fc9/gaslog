<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class SchoolTypeEnum extends Enum implements LocalizedEnum
{
    const MUNICIPAL_PUBLIC = 1;
    const STATE_PUBLIC = 2;
    const FEDERAL_PUBLIC = 3;
    const COMMUNITY = 4;
    const PARTICULAR = 5;
    const ONG = 6;
    const OTHER = 0;
}
