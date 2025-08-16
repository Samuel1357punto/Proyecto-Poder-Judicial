<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Municipio;

class MunicipioSeeder extends Seeder
{
    public function run(): void
    {
        $municipios = [
            'VICTORIA',
            'ALTAMIRA',
            'CIUDAD MADERO',
            'TAMPICO',
            'REYNOSA',
            'RÍO BRAVO',
            'MATAMOROS',
            'NUEVO LAREDO',
            'VALLE HERMOSO',
            'SAN FERNANDO',
            'EL MANTE',
            'GONZÁLEZ',
            'XICOTÉNCATL',
            'LLERA',
            'TULA',
            'SOTO LA MARINA',
            'JAUMAVE',
            'PADILLA',
            'HIDALGO',
            'VILLAGRÁN'
        ];

        foreach ($municipios as $nombre) {
            Municipio::create(['nombre' => $nombre]);
        }

        $this->command->info('✅ Municipios creados exitosamente');
    }
}