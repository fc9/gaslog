<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class GroupMemberTypeEnum extends Enum implements LocalizedEnum
{
    const Educator =   1;
    const Student =   2;
}
