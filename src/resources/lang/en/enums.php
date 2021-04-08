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
        CityNumberOfInhabitantsEnum::Max_10000 => 'Up to 10,000 inhabitants',
        CityNumberOfInhabitantsEnum::Between_10000_and_25000 => 'Between 10,000 and 25,000 inhabitants',
        CityNumberOfInhabitantsEnum::Between_25000_and_50000 => 'Between 25,000 and 50,000 inhabitants',
        CityNumberOfInhabitantsEnum::Between_50000_and_200000 => 'Between 50,000 and 200,000 inhabitants',
        CityNumberOfInhabitantsEnum::Between_200000_and_500000 => 'Between 200,000 and 500,000 inhabitants',
        CityNumberOfInhabitantsEnum::Min_500000 => 'More than 500,000 inhabitants',
    ],

    GroupMemberTypeEnum::class => [
        GroupMemberTypeEnum::Educator => 'educator',
        GroupMemberTypeEnum::Student => 'student',
    ],

    MissionEnum::class => [
        MissionEnum::domingo => 'Sunday',
        MissionEnum::segundaFeira => 'Monday',
        MissionEnum::tercaFeira => 'Tuesday',
        MissionEnum::quartaFeira => 'Wednesday',
        MissionEnum::quintaFeira => 'Thursday',
        MissionEnum::sextaFeira => 'Friday',
        MissionEnum::sabado => 'Saturday',
    ],

    SchoolDegreeEnum::class => [
        //SchoolDegreeEnum::Infantil => 'Kindergarten',
        SchoolDegreeEnum::ANO_1_FUNDAMENTAL => '1st year of Elementary School',
        SchoolDegreeEnum::ANO_2_FUNDAMENTAL => '2nd year of Elementary School',
        SchoolDegreeEnum::ANO_3_FUNDAMENTAL => '3rd year of Elementary School',
        SchoolDegreeEnum::ANO_4_FUNDAMENTAL => '4th year of Elementary School',
        SchoolDegreeEnum::ANO_5_FUNDAMENTAL => '5th year of Elementary School',
        SchoolDegreeEnum::ANO_6_FUNDAMENTAL => '6th year of Elementary School',
        SchoolDegreeEnum::ANO_7_FUNDAMENTAL => '7th year of Elementary School',
        SchoolDegreeEnum::ANO_8_FUNDAMENTAL => '8th year of Elementary School',
        SchoolDegreeEnum::ANO_9_FUNDAMENTAL => '9th year of Elementary School',
        SchoolDegreeEnum::ANO_1_MEDIO => '10st year of high school',
        SchoolDegreeEnum::ANO_2_MEDIO => '11st year of high school',
        SchoolDegreeEnum::ANO_3_MEDIO => '12st year of high school',
    ],

    SchoolTypeEnum::class => [
        SchoolTypeEnum::MUNICIPAL_PUBLIC => 'Public School - Municipal',
        SchoolTypeEnum::STATE_PUBLIC => 'Public School - State',
        SchoolTypeEnum::FEDERAL_PUBLIC => 'Public School - Federal',
        SchoolTypeEnum::COMMUNITY => 'Community School',
        SchoolTypeEnum::PARTICULAR => 'Private school',
        SchoolTypeEnum::ONG => 'NGO',
        SchoolTypeEnum::OTHER => 'Others',
    ],

];