<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\UserModel;
use Database\Seeders\RolSeeder;
class UserSeeder extends Seeder
{
    public function run()
    {

        $this->call(RolSeeder::class);

        // 2. Creamos el usuario Admin corto de forma segura
        UserModel::updateOrCreate(
            ['email' => 'admin@paseillo.com'],
            [
                'name'     => 'Admin Paseillo',
                'username' => 'admin',
                'password' => Hash::make('admin123'),
                'role_id'  => 1,
            ]
        );
    }
}
