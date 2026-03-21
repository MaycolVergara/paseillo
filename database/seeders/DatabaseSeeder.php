<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Aquí llamamos a tu seeder de usuario
        $this->call([

            TableSeeder::class,
            CategorySeeder::class,
            UserSeeder::class,

        ]);
    }
}
