<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\StoreModel;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Asegurar categorías básicas
        $categories = [
            ['id' => 1, 'name' => 'Hamburguesas'],
            ['id' => 2, 'name' => 'Pizzas'],
            ['id' => 3, 'name' => 'krispys'],
            ['id' => 4, 'name' => 'Salchipapas'],
            ['id' => 6, 'name' => 'Bebidas'],
        ];

        foreach ($categories as $cat) {
            CategoryModel::updateOrCreate(['id' => $cat['id']], $cat);
        }

        $storePan = StoreModel::where('name', 'Pan Burger')->first()->id ?? null;

        $products = [
            // HAMBURGUESAS
            ['name' => 'Hamburguesa Simple', 'price' => 10.00, 'category_id' => 1, 'stores_id' => $storePan],
            ['name' => 'Hamburguesa Doble', 'price' => 15.00, 'category_id' => 1, 'stores_id' => $storePan],
            ['name' => 'Hamburguesa Especial', 'price' => 18.00, 'category_id' => 1, 'stores_id' => $storePan],
            
            // PIZZAS
            ['name' => 'Pizza Americana', 'price' => 25.00, 'category_id' => 2],
            ['name' => 'Pizza Pepperoni', 'price' => 28.00, 'category_id' => 2],
            ['name' => 'Pizza Hawaiana', 'price' => 30.00, 'category_id' => 2],

            // KRISPYS
            ['name' => 'Krispy Chicken 2pzs', 'price' => 15.00, 'category_id' => 3],
            ['name' => 'Krispy Chicken 4pzs', 'price' => 25.00, 'category_id' => 3],

            // BEBIDAS (Gaseosa, Chicha, Agua)
            ['name' => 'Gaseosa Inka Cola 500ml', 'price' => 3.50, 'category_id' => 6],
            ['name' => 'Gaseosa Coca Cola 1.5L', 'price' => 8.00, 'category_id' => 6],
            ['name' => 'Chicha Morada Vaso', 'price' => 4.00, 'category_id' => 6],
            ['name' => 'Chicha Morada Jarra', 'price' => 12.00, 'category_id' => 6],
            ['name' => 'Agua San Mateo', 'price' => 2.50, 'category_id' => 6],
        ];

        foreach ($products as $prod) {
            ProductModel::updateOrCreate(['name' => $prod['name']], $prod);
        }
    }
}
