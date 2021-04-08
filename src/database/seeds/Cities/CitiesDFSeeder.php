<?php

use Illuminate\Database\Seeder;
use App\Models\City;

class CitiesDFSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $state = 'DF';

        $cities = [
            'Brasília',
        ];

        foreach ($cities as $city) {
            City::updateOrCreate(['name' => $city, 'state' => $state]);
        }
    }

}
