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

        // 2. Arranca en cero para que la pantalla no cargue basura al inicio
        $sales = collect();
        $totalDay = 0;

        // 3. Solo hace la búsqueda si le diste un rango de tiempo real
        if ($start_date && $end_date) {

            // Limpia el formato de fecha de HTML para que la base de datos no dé error
            $filterStart = str_replace('T', ' ', $start_date) . ':00';
            $filterEnd = str_replace('T', ' ', $end_date) . ':59';

            // 🔍 FILTRO CLAVE: Solo cuenta las ventas que ya están PAGADAS (Finalizado)
            // Busca todo lo que esté "entre" el inicio y el fin del turno
            $sales = Sale::where('status', 'Finalizado')
                ->whereBetween('date', [$filterStart, $filterEnd])
                ->get();

            // Suma todos los totales de la lista para darte el monto final
            $totalDay = $sales->sum('total');
        }

        $cashPayment = $sales->where('payment_method', 'cash')->sum('total');

        $yapePayment = $sales->where('payment_method', 'yape')->sum('total');

        $cardPayment = $sales->where('payment_method', 'card')->sum('total');


        return view('/saleDetails',
            compact('sales', 'totalDay', 'start_date', 'end_date', 'yapePayment', 'cardPayment', 'cashPayment'));
    }
}
