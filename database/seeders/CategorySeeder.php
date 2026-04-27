<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class   CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['id' => 1, 'name' => 'ALITAS A LA BBQ'],
            ['id' => 2, 'name' => 'GASEOSA COCA COLA 1 1/2 LT'],
            ['id' => 3, 'name' => 'GASEOSA COCA COLA 1 LT'],
            ['id' => 4, 'name' => 'GASEOSA GORDITA'],
            ['id' => 5, 'name' => 'GASEOSA INCA KOLA 1 1/2 LT'],
            ['id' => 6, 'name' => 'GASEOSA INCA KOLA 1 LT'],
            ['id' => 7, 'name' => 'HAMBURGUESAS'],
            ['id' => 8, 'name' => 'PARRILLAS'],
            ['id' => 9, 'name' => 'PASTAS'],
            ['id' => 10, 'name' => 'PIZZAS'],
            ['id' => 11, 'name' => 'SALCHIPAPAS'],
            ['id' => 12, 'name' => 'CHICHA MORADA'],
        ];

        foreach ($categories as $cat) {
            DB::table('categories')->updateOrInsert(
                ['id' => $cat['id']],
                ['name' => $cat['name'], 'updated_at' => now(), 'created_at' => now()]
            );
        }
    }
}
