<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StoreModel;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'name' => 'Pan Burger',
                'current_stock' => 10,
                'minimum_stock' => 50,
                'unit' => 'Unid',
            ],
            [
                'name' => 'Queso Cheddar',
                'current_stock' => 5,
                'minimum_stock' => 20,
                'unit' => 'Paquetes',
            ],
            [
                'name' => 'Carne Burger',
                'current_stock' => 120,
                'minimum_stock' => 50,
                'unit' => 'Unid',
            ],
            [
                'name' => 'Gaseosa Inka Cola 1.5L',
                'current_stock' => 2,
                'minimum_stock' => 12,
                'unit' => 'Botellas',
            ],
            [
                'name' => 'Papas Pre-fritas',
                'current_stock' => 60,
                'minimum_stock' => 40,
                'unit' => 'Kg',
            ]
        ];

        foreach ($items as $item) {
            StoreModel::updateOrCreate(['name' => $item['name']], $item);
        }
    }
}
