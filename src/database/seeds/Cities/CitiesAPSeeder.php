<?php

use Illuminate\Database\Seeder;
use App\Models\City;

class CitiesAPSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $state = 'AP';

        $cities = [
            'Serra do Navio', 'Amapá', 'Pedra Branca do Amapari', 'Calçoene',
            'Cutias', 'Ferreira Gomes', 'Itaubal', 'Laranjal do Jari', 'Macapá',
            'Mazagão', 'Oiapoque', 'Porto Grande', 'Pracuúba', 'Santana',
            'Tartarugalzinho', 'Vitória do Jari',
        ];

        foreach ($cities as $city) {
            City::updateOrCreate(['name' => $city, 'state' => $state]);
        }
    }

}
