<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run()
    {
        DB::table('categories')->insert([
            ['id' => 1, 'name' => 'Hamburguesas'],
            ['id' => 2, 'name' => 'Pizzas'],
            ['id' => 3, 'name' => 'krispys'],
            ['id' => 4, 'name' => 'Salchipapas'],
            ['id' => 5, 'name' => 'Alitas'],
            ['id' => 6, 'name' => 'Bebidas'],

        ]);
    }
}
