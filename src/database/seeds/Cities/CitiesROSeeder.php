<?php

use Illuminate\Database\Seeder;
use App\Models\City;

class CitiesROSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $state = 'RO';

        $cities = [
            'Alta Floresta D\'Oeste',
            'Ariquemes',
            'Cabixi',
            'Cacoal',
            'Cerejeiras',
            'Colorado do Oeste',
            'Corumbiara',
            'Costa Marques',
            'Espigão D\'Oeste',
            'Guajará-Mirim',
            'Jaru',
            'Ji-Paraná',
            'Machadinho D\'Oeste',
            'Nova Brasilândia D\'Oeste',
            'Ouro Preto do Oeste',
            'Pimenta Bueno',
            'Porto Velho',
            'Presidente Médici',
            'Rio Crespo',
            'Rolim de Moura',
            'Santa Luzia D\'Oeste',
            'Vilhena',
            'São Miguel do Guaporé',
            'Nova Mamoré',
            'Alvorada D\'Oeste',
            'Alto Alegre dos Parecis',
            'Alto Paraíso',
            'Buritis',
            'Novo Horizonte do Oeste',
            'Cacaulândia',
            'Campo Novo de Rondônia',
            'Candeias do Jamari',
            'Castanheiras',
            'Chupinguaia',
            'Cujubim',
            'Governador Jorge Teixeira',
            'Itapuã do Oeste',
            'Ministro Andreazza',
            'Mirante da Serra',
            'Monte Negro',
            'Nova União',
            'Parecis',
            'Pimenteiras do Oeste',
            'Primavera de Rondônia',
            'São Felipe D\'Oeste',
            'São Francisco do Guaporé',
            'Seringueiras',
            'Teixeirópolis',
            'Theobroma',
            'Urupá',
            'Vale do Anari',
            'Vale do Paraíso',
        ];

        foreach ($cities as $city) {
            City::updateOrCreate(['name' => $city, 'state' => $state]);
        }
    }

}
