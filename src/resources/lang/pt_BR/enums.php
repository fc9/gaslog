<?php

use App\Enums\{
    CityNumberOfInhabitantsEnum,
    GroupMemberTypeEnum,
    MissionEnum,
    SchoolDegreeEnum,
    SchoolTypeEnum,
};

return [

    CityNumberOfInhabitantsEnum::class => [
        CityNumberOfInhabitantsEnum::Max_10000 => 'Até 10.000 habitantes',
        CityNumberOfInhabitantsEnum::Between_10000_and_25000 => 'Entre 10.000 e 25.000 habitantes',
        CityNumberOfInhabitantsEnum::Between_25000_and_50000 => 'Entre 25.000 e 50.000 habitantes',
        CityNumberOfInhabitantsEnum::Between_50000_and_200000 => 'Entre 50.000 e 200.000 habitantes',
        CityNumberOfInhabitantsEnum::Between_200000_and_500000 => 'Entre 200.000 e 500.000 habitantes',
        CityNumberOfInhabitantsEnum::Min_500000 => 'Mais de 500.000 habitantes',
    ],

    GroupMemberTypeEnum::class => [
        GroupMemberTypeEnum::Educator => 'educador',
        GroupMemberTypeEnum::Student => 'estudante',
    ],

    MissionEnum::class => [
        MissionEnum::domingo => 'Domingo',
        MissionEnum::segundaFeira => 'Segunda-feira',
        MissionEnum::tercaFeira => 'Terça-feira',
        MissionEnum::quartaFeira => 'Quarta-feira',
        MissionEnum::quintaFeira => 'Quinta-feira',
        MissionEnum::sextaFeira => 'Sexta-feira',
        MissionEnum::sabado => 'Sábado',
    ],

    SchoolDegreeEnum::class => [
        //SchoolDegreeEnum::Infantil => 'Infantil',
        SchoolDegreeEnum::ANO_1_FUNDAMENTAL => '1º ano do E. Fundamental',
        SchoolDegreeEnum::ANO_2_FUNDAMENTAL => '2º ano do E. Fundamental',
        SchoolDegreeEnum::ANO_3_FUNDAMENTAL => '3º ano do E. Fundamental',
        SchoolDegreeEnum::ANO_4_FUNDAMENTAL => '4º ano do E. Fundamental',
        SchoolDegreeEnum::ANO_5_FUNDAMENTAL => '5º ano do E. Fundamental',
        SchoolDegreeEnum::ANO_6_FUNDAMENTAL => '6º ano do E. Fundamental',
        SchoolDegreeEnum::ANO_7_FUNDAMENTAL => '7º ano do E. Fundamental',
        SchoolDegreeEnum::ANO_8_FUNDAMENTAL => '8º ano do E. Fundamental',
        SchoolDegreeEnum::ANO_9_FUNDAMENTAL => '9º ano do E. Fundamental',
        SchoolDegreeEnum::ANO_1_MEDIO => '1º ano do E. Médio',
        SchoolDegreeEnum::ANO_2_MEDIO => '2º ano do E. Médio',
        SchoolDegreeEnum::ANO_3_MEDIO => '3º ano do E. Médio',
    ],

    SchoolTypeEnum::class => [
        SchoolTypeEnum::MUNICIPAL_PUBLIC => 'Escola Pública - Municipal',
        SchoolTypeEnum::STATE_PUBLIC => 'Escola Pública - Estadual',
        SchoolTypeEnum::FEDERAL_PUBLIC => 'Escola Pública - Federal',
        SchoolTypeEnum::COMMUNITY => 'Escola Comunitária',
        SchoolTypeEnum::PARTICULAR => 'Escola Particular',
        SchoolTypeEnum::ONG => 'ONG',
        SchoolTypeEnum::OTHER => 'Outros',
    ],

];