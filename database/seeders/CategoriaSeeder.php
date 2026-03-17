<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    public function run()
    {
        DB::table('categorias')->insert([
            ['id_categoria' => 1, 'nombre_categoria' => 'Hamburguesas'],
            ['id_categoria' => 2, 'nombre_categoria' => 'Pizzas'],
            ['id_categoria' => 3, 'nombre_categoria' => 'krispys'],
            ['id_categoria' => 4, 'nombre_categoria' => 'Salchipapas'],
            ['id_categoria' => 5, 'nombre_categoria' => 'Alitas'],
            ['id_categoria' => 6, 'nombre_categoria' => 'Bebidas'],

        ]);
    }
}
