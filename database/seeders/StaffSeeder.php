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

        // 1. Administrador (ENTRADA PRINCIPAL)
        $staff1 = StaffModel::updateOrCreate(
            ['email' => 'admin@paseillo.com'],
            [
                'name' => 'Maycol', 'surname' => 'Vergara', 'phone' => '987654321', 'dni' => '77665541',
                'salary' => 1900.00, 'advance_payment' => 0.00,
                'position' => 'Administrador', 'is_active' => true, 'payment_day' => $hoy
            ]
        );
        UserModel::updateOrCreate(
            ['staff_id' => $staff1->id],
            ['username' => 'admin', 'password' => Hash::make('admin123'), 'role_id' => 1]
        );
    }
}
