<?php

use Illuminate\Database\Seeder;
use App\Models\City;

class CitiesACSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $state = 'AC';

        $cities = [
            'Acrelândia', 'Assis Brasil', 'Brasiléia', 'Bujari', 'Capixaba',
            'Cruzeiro do Sul', 'Epitaciolândia', 'Feijó', 'Jordão',
            'Mâncio Lima', 'Manoel Urbano', 'Marechal Thaumaturgo',
            'Plácido de Castro', 'Porto Walter', 'Rio Branco',
            'Rodrigues Alves', 'Santa Rosa do Purus', 'Senador Guiomard',
            'Sena Madureira', 'Tarauacá', 'Xapuri', 'Porto Acre',
        ];

        foreach ($cities as $city) {
            City::updateOrCreate(['name' => $city, 'state' => $state]);
        }
    }

}
