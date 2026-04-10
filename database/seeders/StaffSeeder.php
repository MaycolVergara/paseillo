<?php

namespace Database\Seeders;

use App\Models\StaffModel;
use App\Models\UserModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class StaffSeeder extends Seeder
{

    public function run(): void
    {
        $this->call(RolSeeder::class);
        $staff = StaffModel::create([
            'name' => 'Maycol',
            'surname' => 'Vergara',
            'phone' => '987654321',
            'dni' => '77665544',
            'email' => 'admin@paseillo.com',
            'salary' => 2500.00,
            'position' => 'Administrador',
            'is_active' => true,
        ]);

        UserModel::create([
            'staff_id' => $staff->id, // 👈 Relación clave
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'role_id' => 1, // Asegúrate de que el Rol 1 sea Admin
        ]);
    }
}
