<?php

namespace Database\Seeders;

use App\Models\StaffModel;
use App\Models\TableDeliveryModel;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RolSeeder::class,
           // CategorySeeder::class,
            //ProductSeeder::class,
            StaffSeeder::class,
            //SettingSeeder::class,
            //TableSeeder::class,
            //cTableDeliverySeeder::class,
        ]);
    }
}
