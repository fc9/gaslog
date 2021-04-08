<?php


use Illuminate\Database\Seeder;
use App\Models\City;

class CitiesAMSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $state = 'AM';

        $cities = [
            'Alvarães', 'Amaturá', 'Anamã', 'Anori', 'Apuí', 'Atalaia do Norte',
            'Autazes', 'Barcelos', 'Barreirinha', 'Benjamin Constant',
            'Beruri', 'Boa Vista do Ramos', 'Boca do Acre', 'Borba',
            'Caapiranga', 'Canutama', 'Carauari', 'Careiro',
            'Careiro da Várzea', 'Coari', 'Codajás', 'Eirunepé', 'Envira',
            'Fonte Boa', 'Guajará', 'Humaitá', 'Ipixuna', 'Iranduba',
            'Itacoatiara', 'Itamarati', 'Itapiranga', 'Japurá', 'Juruá',
            'Jutaí', 'Lábrea', 'Manacapuru', 'Manaquiri', 'Manaus', 'Manicoré',
            'Maraã', 'Maués', 'Nhamundá', 'Nova Olinda do Norte', 'Novo Airão',
            'Novo Aripuanã', 'Parintins', 'Pauini', 'Presidente Figueiredo',
            'Rio Preto da Eva', 'Santa Isabel do Rio Negro',
            'Santo Antônio do Içá', 'São Gabriel da Cachoeira',
            'São Paulo de Olivença', 'São Sebastião do Uatumã', 'Silves',
            'Tabatinga', 'Tapauá', 'Tefé', 'Tonantins', 'Uarini', 'Urucará',
            'Urucurituba',
        ];

        foreach ($cities as $city) {
            City::updateOrCreate(['name' => $city, 'state' => $state]);
        }
    }

}
