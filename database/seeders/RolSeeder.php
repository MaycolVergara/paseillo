<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RoleModel;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RoleModel::insert([
            ['id' => 1, 'name' => 'Administrador']
            , ['id' => 2, 'name' => 'Mozo'],

        ]);
    }
}
