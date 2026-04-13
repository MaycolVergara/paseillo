<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SaleModel;

class SaleController extends Controller
{
    /**
     * Muestra el histórico de ventas y el cierre de caja.
     * Filtra los resultados por un rango de fecha y hora que tú elijas.
     */
    public function index(Request $request)
    {
        // 1. Atrapa las fechas que pones en el calendario o define hoy por defecto
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        // Si no hay fechas, definimos el rango de HOY (00:00 a 23:59)
        if (!$start_date || !$end_date) {
            $filterStart = \Carbon\Carbon::today()->startOfDay()->toDateTimeString();
            $filterEnd = \Carbon\Carbon::today()->endOfDay()->toDateTimeString();
        } else {
            $filterStart = str_replace('T', ' ', $start_date) . ':00';
            $filterEnd = str_replace('T', ' ', $end_date) . ':59';
        }

        // 2. Cargamos las ventas filtradas por el rango seleccionado
        $filteredSales = SaleModel::where('status', 'Finalizado')
            ->whereBetween('date', [$filterStart, $filterEnd])
            ->get();

        // 3. Calculamos TODAS las tarjetas basándonos SOLO en el filtro
        $totalDay = $filteredSales->sum('total');
        $totalVentas = $filteredSales->count();
        $ventasSalon = $filteredSales->whereNotNull('table_id')->count();
        $ventasDelivery = $filteredSales->whereNotNull('table_delivery_id')->count();

        // Pagos por método (Solo del periodo filtrado)
        $cashPayment = $filteredSales->where('payment_method', 'cash')->sum('total');
        $yapePayment = $filteredSales->where('payment_method', 'yape')->sum('total');
        $cardPayment = $filteredSales->where('payment_method', 'card')->sum('total');

        // 4. Las ventas detalladas para la tabla (ya filtradas arriba)
        $sales = $filteredSales;

        return view('/saleDetails', compact(
            'sales', 'totalDay', 'start_date', 'end_date', 
            'yapePayment', 'cardPayment', 'cashPayment', 
            'totalVentas', 'ventasSalon', 'ventasDelivery'
        ));
    }
}
