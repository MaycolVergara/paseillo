<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TableSeeder extends Seeder
{
    public function run()
    {
        DB::table('tables')->insert([
            ['id' => 1, 'table_number' => 1, 'status' => 'disponible'],
            ['id' => 2, 'table_number' => 2, 'status' => 'disponible'],
            ['id' => 3, 'table_number' => 3, 'status' => 'disponible'],
            ['id' => 4, 'table_number' => 4, 'status' => 'disponible'],
            ['id' => 5, 'table_number' => 5, 'status' => 'disponible'],
        ]);
    }
}
