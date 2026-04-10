<?php

namespace Database\Seeders;

use App\Models\StaffModel;
use App\Models\TableDeliveryModel;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Aquí llamamos a tu seeder de usuario
        $this->call([
            StaffSeeder::class,
            TableDeliverySeeder::class,
            TableSeeder::class,
            CategorySeeder::class,

        ]);
    }
}
