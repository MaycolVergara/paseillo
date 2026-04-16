<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SettingModel;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SettingModel::updateOrCreate(
            ['id' => 1], // Solo un registro de configuración
            [
                'company_name' => 'Paseillo',
                'company_subtitle' => 'Burger & Pizzas',
                'company_logo' => 'img/logo_principal.png',
            ]
        );
    }
}
