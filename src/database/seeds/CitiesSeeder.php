<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CitiesSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Model::unguard();

        $this->call(CitiesACSeeder::class);
        $this->call(CitiesALSeeder::class);
        $this->call(CitiesAMSeeder::class);
        $this->call(CitiesAPSeeder::class);
        $this->call(CitiesBASeeder::class);
        $this->call(CitiesCESeeder::class);
        $this->call(CitiesDFSeeder::class);
        $this->call(CitiesESSeeder::class);
        $this->call(CitiesGOSeeder::class);
        $this->call(CitiesMASeeder::class);
        $this->call(CitiesMGSeeder::class);
        $this->call(CitiesMSSeeder::class);
        $this->call(CitiesMTSeeder::class);
        $this->call(CitiesPASeeder::class);
        $this->call(CitiesPBSeeder::class);
        $this->call(CitiesPESeeder::class);
        $this->call(CitiesPISeeder::class);
        $this->call(CitiesPRSeeder::class);
        $this->call(CitiesRJSeeder::class);
        $this->call(CitiesRNSeeder::class);
        $this->call(CitiesROSeeder::class);
        $this->call(CitiesRRSeeder::class);
        $this->call(CitiesRSSeeder::class);
        $this->call(CitiesSCSeeder::class);
        $this->call(CitiesSESeeder::class);
        $this->call(CitiesSPSeeder::class);
        $this->call(CitiesTOSeeder::class);

    }

}
