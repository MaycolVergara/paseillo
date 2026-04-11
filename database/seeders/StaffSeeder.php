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

        // Limpiar para que no se dupliquen al correr multiple veces
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        UserModel::truncate();
        StaffModel::truncate();
        \DB::table('staff_absences')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $hoy = \Carbon\Carbon::now()->day;

        // 1. Administrador (1900)
        $staff1 = StaffModel::create([
            'name' => 'Maycol', 'surname' => 'Vergara', 'phone' => '987654321', 'dni' => '77665541',
            'email' => 'admin@paseillo.com', 'salary' => 1900.00, 'advance_payment' => 400.00,
            'position' => 'Administrador', 'is_active' => true, 'payment_day' => $hoy
        ]);
        UserModel::create(['staff_id' => $staff1->id, 'username' => 'admin', 'password' => Hash::make('admin123'), 'role_id' => 1]);

        // 2. Cocinero (2500)
        StaffModel::create([
            'name' => 'Carlos', 'surname' => 'Chef', 'phone' => '987654322', 'dni' => '77665542',
            'email' => 'cocina@paseillo.com', 'salary' => 2500.00, 'advance_payment' => 500.00,
            'position' => 'Cocinero', 'is_active' => true, 'payment_day' => $hoy
        ]);

        // 3. Mozo 1 (1500)
        $staff3 = StaffModel::create([
            'name' => 'Luis', 'surname' => 'Mozo', 'phone' => '987654323', 'dni' => '77665543',
            'email' => 'mozo1@paseillo.com', 'salary' => 1500.00, 'advance_payment' => 200.00,
            'position' => 'Mozo', 'is_active' => true, 'payment_day' => $hoy
        ]);
        UserModel::create(['staff_id' => $staff3->id, 'username' => 'mozo1', 'password' => Hash::make('mozo123'), 'role_id' => 2]);

        // 4. Mozo 2 (1500)
        $staff4 = StaffModel::create([
            'name' => 'Ana', 'surname' => 'Mozita', 'phone' => '987654324', 'dni' => '77665544',
            'email' => 'mozo2@paseillo.com', 'salary' => 1500.00, 'advance_payment' => 0.00,
            'position' => 'Mozo', 'is_active' => true, 'payment_day' => $hoy
        ]);
        UserModel::create(['staff_id' => $staff4->id, 'username' => 'mozo2', 'password' => Hash::make('mozo123'), 'role_id' => 2]);
        
        // Simular dos inasistencias en la tabla staff_absences para la Moza
        \DB::table('staff_absences')->insert([
            ['staff_id' => $staff4->id, 'absence_date' => \Carbon\Carbon::now()->subDays(2)->format('Y-m-d'), 'status' => 'pending', 'created_at' => now(), 'updated_at' => now()],
            ['staff_id' => $staff4->id, 'absence_date' => \Carbon\Carbon::now()->subDays(5)->format('Y-m-d'), 'status' => 'pending', 'created_at' => now(), 'updated_at' => now()]
        ]);

        // 5. Limpieza (1200)
        StaffModel::create([
            'name' => 'Juana', 'surname' => 'Limpieza', 'phone' => '987654325', 'dni' => '77665545',
            'email' => 'limpieza@paseillo.com', 'salary' => 1200.00, 'advance_payment' => 150.00,
            'position' => 'Limpieza', 'is_active' => true, 'payment_day' => $hoy
        ]);
    }
}
