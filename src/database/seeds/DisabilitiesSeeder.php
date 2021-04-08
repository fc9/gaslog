<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\Disability;

class DisabilitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $actions = [
            ['name' => 'Altas habilidades/superdotação','type' => 'checkbox'],
            ['name' => 'Deficiência intelectual','type' => 'checkbox'],
            ['name' => 'Deficiência auditiva','type' => 'checkbox'],
            ['name' => 'Deficiência visual','type' => 'checkbox'],
            ['name' => 'Deficiência física','type' => 'checkbox'],
            ['name' => 'Transtorno do espectro autista (TEA)','type' => 'checkbox'],
            ['name' => 'Outros','type' => 'text'],
        ];

        foreach ($actions as $action) {
            echo "Processando disabilities {$action['name']}\n";

            $res = Disability::updateOrCreate(
                ["name" => $action['name'] ],
                $action,
            );
        }
    }
}
