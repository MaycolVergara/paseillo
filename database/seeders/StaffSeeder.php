<?php

namespace Database\Seeders;

use App\Models\StaffModel;
use App\Models\UserModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class StaffSeeder extends Seeder
{
    public function run(): void
    {
        $hoy = \Carbon\Carbon::now()->day;

        $staffData = [
            [
                'name' => 'Carlos', 'surname' => 'Administrador', 'phone' => '900000001', 'dni' => '11111111',
                'salary' => 1200.00, 'advance_payment' => 300.00,
                'position' => 'Administrador', 'is_active' => true, 'payment_day' => $hoy
            ],
            [
                'name' => 'Luis', 'surname' => 'Mozo Uno', 'phone' => '900000002', 'dni' => '22222222',
                'salary' => 1025.00, 'advance_payment' => 150.00,
                'position' => 'Mozo', 'is_active' => true, 'payment_day' => $hoy
            ],
            [
                'name' => 'Ana', 'surname' => 'Moza Dos', 'phone' => '900000003', 'dni' => '33333333',
                'salary' => 1025.00, 'advance_payment' => 50.00,
                'position' => 'Mozo', 'is_active' => true, 'payment_day' => $hoy
            ],
            [
                'name' => 'Pedro', 'surname' => 'Chef Principal', 'phone' => '900000004', 'dni' => '44444444',
                'salary' => 1150.00, 'advance_payment' => 0.00,
                'position' => 'Chef', 'is_active' => true, 'payment_day' => $hoy
            ],
            [
                'name' => 'Rosa', 'surname' => 'Limpieza', 'phone' => '900000005', 'dni' => '55555555',
                'salary' => 950.00, 'advance_payment' => 0.00,
                'position' => 'Limpieza', 'is_active' => true, 'payment_day' => $hoy
            ],
            [
                'name' => 'Jorge', 'surname' => 'Cajero', 'phone' => '900000006', 'dni' => '66666666',
                'salary' => 1100.00, 'advance_payment' => 0.00,
                'position' => 'Cajero', 'is_active' => true, 'payment_day' => $hoy
            ],
        ];

        foreach ($staffData as $data) {
            $s = StaffModel::updateOrCreate(['dni' => $data['dni']], $data);
            
            // Si es Administrador o Mozo, creamos/actualizamos su usuario
            if ($data['position'] == 'Administrador') {
                UserModel::updateOrCreate(
                    ['username' => 'admin'],
                    ['staff_id' => $s->id, 'password' => Hash::make('admin123'), 'role_id' => 1]
                );
            } elseif ($data['position'] == 'Mozo') {
                $username = strtolower($data['name']) . '1';
                UserModel::updateOrCreate(
                    ['username' => $username],
                    ['staff_id' => $s->id, 'password' => Hash::make($username.'123'), 'role_id' => 2]
                );
            }
        }
    }
}
