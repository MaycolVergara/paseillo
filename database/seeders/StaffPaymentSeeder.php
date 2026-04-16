<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StaffPaymentModel;
use App\Models\StaffModel;
use Carbon\Carbon;

class StaffPaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener 3 empleados que tengan adelantos para simular el pago
        $staffWithAdvances = StaffModel::where('advance_payment', '>', 0)->take(3)->get();

        foreach ($staffWithAdvances as $s) {
            StaffPaymentModel::create([
                'staff_id' => $s->id,
                'payment_type' => 'salary',
                'base_salary' => $s->salary,
                'advance_deducted' => $s->advance_payment,
                'net_paid' => $s->salary - $s->advance_payment,
                'notes' => 'Pago del mes con descuento de adelanto.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
