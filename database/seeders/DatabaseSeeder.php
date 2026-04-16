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
            StoreSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            StaffSeeder::class,
            SettingSeeder::class,
            TableSeeder::class,
            TableDeliverySeeder::class,
            SaleSeeder::class,
            StaffPaymentSeeder::class,
        ]);
    }
}
