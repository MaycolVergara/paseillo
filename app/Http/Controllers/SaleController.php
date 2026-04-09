<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;

class SaleController extends Controller
{
    /**
     * Muestra el histórico de ventas y el cierre de caja.
     * Filtra los resultados por un rango de fecha y hora que tú elijas.
     */
    public function index(Request $request)
    {
        // 1. Atrapa las fechas que pones en el calendario del panel
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        // 2. SIEMPRE carga todas las ventas finalizadas para las tarjetas de resumen
        $allSales = Sale::where('status', 'Finalizado')->get();
        $totalDay = $allSales->sum('total');

        // 3. Calcula los pagos por método con TODAS las ventas (siempre visible)
        $cashPayment = $allSales->where('payment_method', 'cash')->sum('total');
        $yapePayment = $allSales->where('payment_method', 'yape')->sum('total');
        $cardPayment = $allSales->where('payment_method', 'card')->sum('total');
        $plinPayment = $allSales->where('payment_method', 'plin')->sum('total');

        // Conteos generales para las tarjetas
        $totalVentas = $allSales->count();
        $ventasSalon = $allSales->whereNotNull('table_id')->count();
        $ventasDelivery = $allSales->whereNotNull('table_delivery_id')->count();

        // 4. Solo filtra las ventas para la tabla de detalle cuando hay fechas
        $sales = collect();
        if ($start_date && $end_date) {
            $filterStart = str_replace('T', ' ', $start_date) . ':00';
            $filterEnd = str_replace('T', ' ', $end_date) . ':59';

            $sales = Sale::where('status', 'Finalizado')
                ->whereBetween('date', [$filterStart, $filterEnd])
                ->get();
        }

        return view('/saleDetails',
            compact('sales', 'totalDay', 'start_date', 'end_date', 'yapePayment', 'cardPayment', 'cashPayment', 'plinPayment', 'totalVentas', 'ventasSalon', 'ventasDelivery'));
    }
}
