<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale; // Antes Ventas

class SaleController extends Controller
{
    public function index(Request $request)
    {
        // 1. Recibimos las fechas del formulario
        $start_date = $request->input('start_date'); // fecha_inicio
        $end_date = $request->input('end_date');     // fecha_cierre

        // 2. Por defecto, la lista está vacía y el total es 0 (Pantalla limpia)
        $sales = collect(); // ventas
        $totalDay = 0;      // totalDia

        // 3. SOLO buscamos en la base de datos si el usuario ingresó ambas fechas
        if ($start_date && $end_date) {

            // Reemplazamos la 'T' del input HTML por un espacio para que MySQL lo entienda
            $filterStart = str_replace('T', ' ', $start_date) . ':00';
            $filterEnd = str_replace('T', ' ', $end_date) . ':59';

            // Usamos whereBetween para buscar entre las dos fechas
            // Cambiamos 'estado' por 'status' y 'fecha' por 'date'
            $sales = Sale::where('status', 'Finalizado')
                ->whereBetween('date', [$filterStart, $filterEnd])
                ->get();

            $totalDay = $sales->sum('total');
        }

        return view('/saleDetails', // Antes /detalleVentas
            compact('sales',
                'totalDay', 'start_date',
                'end_date'));
    }
}
