<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TableDelivey extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('table_delivery')->insert([
            ['id' => 1, 'table_number' => 1, 'status' => 'disponible'],
            ['id' => 2, 'table_number' => 2, 'status' => 'disponible'],
            ['id' => 3, 'table_number' => 3, 'status' => 'disponible'],
            ['id' => 4, 'table_number' => 4, 'status' => 'disponible'],
            ['id' => 5, 'table_number' => 5, 'status' => 'disponible'],
            ['id' => 6, 'table_number' => 6, 'status' => 'disponible'],

        ]);
    }
}
