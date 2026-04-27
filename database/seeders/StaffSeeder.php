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
                'name' => 'Maycol', 'surname' => 'Administrador', 'phone' => '900000001', 'dni' => '76585625',
                'salary' => 1200.00,
                'position' => 'Administrador', 'is_active' => true, 'payment_day' => $hoy
            ],

        ];

        foreach ($staffData as $data) {
            $s = StaffModel::updateOrCreate(['dni' => $data['dni']], $data);

            // Si es Administrador
            if ($data['position'] == 'Administrador') {
                UserModel::updateOrCreate(
                    ['username' => 'admin'],
                    ['staff_id' => $s->id, 'password' => Hash::make('admin123'), 'role_id' => 1]
                );

            }
        }
    }
}
