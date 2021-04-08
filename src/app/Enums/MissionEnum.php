<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class MissionEnum extends Enum implements LocalizedEnum
{
    const domingo = 1;
    const segundaFeira = 2;
    const tercaFeira = 3;
    const quartaFeira = 4;
    const quintaFeira = 5;
    const sextaFeira = 6;
    const sabado = 7;

    public function blade()
    {
        return str_replace('F', '-f', $this->key);
    }
}
