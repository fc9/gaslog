<?php

use Illuminate\Database\Seeder;
use App\Models\City;

class CitiesRRSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $state = 'RR';

        $cities = [
            'Amajari',
            'Alto Alegre',
            'Boa Vista',
            'Bonfim',
            'Cantá',
            'Caracaraí',
            'Caroebe',
            'Iracema',
            'Mucajaí',
            'Normandia',
            'Pacaraima',
            'Rorainópolis',
            'São João da Baliza',
            'São Luiz',
            'Uiramutã',
        ];

        foreach ($cities as $city) {
            City::updateOrCreate(['name' => $city, 'state' => $state]);
        }
    }

}
