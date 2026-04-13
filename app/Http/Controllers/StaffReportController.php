<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\StaffModel;
use App\Models\StaffPaymentModel;
use Carbon\Carbon;

class StaffReportController extends Controller
{
    public function index(){
        $staffMembers = StaffModel::all();

        $totalNomina = 0;
        $totalAdelantos = 0;
        $totalDescuentosFaltas = 0;

        // Agrupación para gráficos por área
        $areas = [
            'Administrativo' => ['nomina' => 0, 'adelantos' => 0],
            'Atención (Mozos)' => ['nomina' => 0, 'adelantos' => 0],
            'Cocina' => ['nomina' => 0, 'adelantos' => 0],
            'Mantenimiento/Limpieza' => ['nomina' => 0, 'adelantos' => 0],
        ];

        foreach ($staffMembers as $staff) {
            // Lógica de Faltas
            $staff->pending_absences_count = $staff->absences()->where('status', 'pending')->count();
            $dailyWage = round($staff->salary / 30, 2);
            $staff->absence_discount = $dailyWage * $staff->pending_absences_count;

            $pos = mb_strtolower($staff->position);

            $key = 'Administrativo';
            if (str_contains($pos, 'mozo')) $key = 'Atención (Mozos)';
            elseif (str_contains($pos, 'cocin')) $key = 'Cocina';
            elseif (str_contains($pos, 'limpieza')) $key = 'Mantenimiento/Limpieza';

            $areas[$key]['nomina'] += $staff->salary;
            $areas[$key]['adelantos'] += $staff->advance_payment;

            $totalNomina += $staff->salary;
            $totalAdelantos += $staff->advance_payment;
            $totalDescuentosFaltas += $staff->absence_discount;
        }

        $totalEmpleados = $staffMembers->count();
        $saldoPagar = $totalNomina - $totalAdelantos - $totalDescuentosFaltas;

        $today = Carbon::now();
        $mesText = $today->translatedFormat('F Y'); // Ej. 'abril 2026'

        // Extraemos los que tienen adelantos, ordenados por los actualizados más recientemente
        $adelantosRecientes = $staffMembers->where('advance_payment', '>', 0)
                                           ->sortByDesc('updated_at')
                                           ->take(4);

        $ultimosPagos = StaffPaymentModel::with('staff')
                        ->whereDate('created_at', Carbon::today())
                        ->orderBy('created_at', 'desc')
                        ->take(3)
                        ->get();

        // Fetch paid staff IDs for the current month
        $paidStaffIds = StaffPaymentModel::whereMonth('created_at', $today->month)
                        ->whereYear('created_at', $today->year)
                        ->where('payment_type', 'salary')
                        ->pluck('staff_id')->toArray();

        // Extraer los trabajadores cuyo pago es hoy y aún no fueron pagados
        $diaActual = $today->day;
        $pendientesPago = $staffMembers->filter(function($staff) use ($diaActual, $paidStaffIds) {
            return $staff->payment_day == $diaActual && !in_array($staff->id, $paidStaffIds);
        })->take(5);

        return view('staffreport', compact(
            'staffMembers',
            'totalNomina',
            'totalAdelantos',
            'totalDescuentosFaltas',
            'saldoPagar',
            'totalEmpleados',
            'areas',
            'today',
            'mesText',
            'adelantosRecientes',
            'ultimosPagos',
            'paidStaffIds',
            'pendientesPago'
        ));
    }

    public function registerPayment(Request $request, $id)
    {
        $staff = StaffModel::findOrFail($id);
        $pendingAbsencesCount = $staff->absences()->where('status', 'pending')->count();
        $dailyWage = round($staff->salary / 30, 2);
        $absenceDiscount = $dailyWage * $pendingAbsencesCount;

        $netPaid = $staff->salary - $staff->advance_payment - $absenceDiscount;

        StaffPaymentModel::create([
            'staff_id' => $staff->id,
            'payment_type' => 'salary',
            'base_salary' => $staff->salary,
            'advance_deducted' => $staff->advance_payment,
            'absences_count' => $pendingAbsencesCount,
            'absences_deducted' => $absenceDiscount,
            'net_paid' => $netPaid,
            'notes' => 'Pago regular de sueldo'
        ]);

        // Reseteamos el adelanto y marcamos faltas como descontadas
        $staff->advance_payment = 0;
        $staff->save();

        if ($pendingAbsencesCount > 0) {
            $staff->absences()->where('status', 'pending')->update(['status' => 'discounted']);
        }

        return response()->json(['success' => true, 'message' => 'Pago registrado correctamente']);
    }

    public function createAdvance()
    {
        $staffMembers = StaffModel::orderBy('name', 'asc')->get();
        return view('staffAdvanceRegistration', compact('staffMembers'));
    }

    public function storeAdvance(Request $request)
    {
        $request->validate([
            'staff_id' => 'required|exists:staff,id',
            'amount' => 'required|numeric|min:0.01'
        ]);

        $staff = StaffModel::findOrFail($request->staff_id);

        // Sumamos el adelanto al adelanto existente
        $staff->advance_payment += $request->amount;
        $staff->save();

        return redirect('/dashboard/staffReport')->with('success', 'Adelanto de S/ ' . number_format($request->amount, 2) . ' registrado para ' . $staff->name);
    }

    // --- MANEJO DE FALTAS E INASISTENCIAS ---
    public function createAbsence()
    {
        $staffMembers = StaffModel::orderBy('name', 'asc')->get();
        return view('staffAbsenceRegistration', compact('staffMembers'));
    }

    public function storeAbsence(Request $request)
    {
        $request->validate([
            'staff_id' => 'required|exists:staff,id',
            'absence_date' => 'required|date',
        ]);

        $staff = StaffModel::findOrFail($request->staff_id);

        \App\Models\StaffAbsenceModel::create([
            'staff_id' => $staff->id,
            'absence_date' => $request->absence_date,
            'status' => 'pending',
            'notes' => $request->notes
        ]);

        return redirect('/dashboard/staffReport')
            ->with('success', 'Inasistencia registrada correctamente para ' . $staff->name);
    }
}
