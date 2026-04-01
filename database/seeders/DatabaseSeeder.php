<?php

namespace Database\Seeders;

use App\Models\TableDelivery;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Aquí llamamos a tu seeder de usuario
        $this->call([
            TableDeliverySeeder::class,
            TableSeeder::class,
            CategorySeeder::class,
            UserSeeder::class,

        ]);
    }
}
