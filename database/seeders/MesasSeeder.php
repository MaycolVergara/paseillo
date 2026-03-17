<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MesasSeeder extends Seeder
{
    public function run()
    {
        DB::table('mesas')->insert([
            ['id_mesa' => 1, 'numero_mesa' => 1, 'estado' => 'disponible'],
            ['id_mesa' => 2, 'numero_mesa' => 2, 'estado' => 'disponible'],
            ['id_mesa' => 3, 'numero_mesa' => 3, 'estado' => 'disponible'],
            ['id_mesa' => 4, 'numero_mesa' => 4, 'estado' => 'disponible'],
            ['id_mesa' => 5, 'numero_mesa' => 5, 'estado' => 'disponible'],
        ]);
    }
}
