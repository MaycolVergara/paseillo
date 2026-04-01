<?php

namespace Database\Seeders;

use App\Models\TableDelivery;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TableDeliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            TableDelivery::create([
                'table_number' => $i,
                'status' => 'disponible'
            ]);
        }

    }
}
