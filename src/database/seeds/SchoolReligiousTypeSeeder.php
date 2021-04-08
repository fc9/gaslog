<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchoolReligiousTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $isEmpty = DB::table('schools_religious_types')->count() === 0;

        if (!$isEmpty) {
            return;
        }

        $religiousTypes = [
            ['name' => 'Católica - Marista'],
            ['name' => 'Católica - Salesiano'],
            ['name' => 'Católica - Jesuítas'],
            ['name' => 'Protestante - Luterano'],
            ['name' => 'Protestante - Presbiteriano'],
            ['name' => 'Protestante - Metodista'],
            ['name' => 'Não somos confessional, nem religiosa'],
            ['name' => 'Outros'],
        ];

        foreach ($religiousTypes as $religiousType) {
            DB::table('schools_religious_types')->insert($religiousType);
        }
    }
}
