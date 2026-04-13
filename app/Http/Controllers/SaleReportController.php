<?php

namespace App\Http\Controllers;

use App\Models\SaleModel;
use App\Models\SaleDetailModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SaleReportController extends Controller
{
    /**
     * Reporte Semanal de Ventas.
     */
    public function weekly()
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $sales = SaleModel::where('status', 'Finalizado')
            ->whereBetween('date', [$startOfWeek, $endOfWeek])
            ->get();

        $totalRevenue = $sales->sum('total');
        $orderCount = $sales->count();
        $title = "Reporte Semanal";
        $subtitle = $startOfWeek->format('d/m') . ' al ' . $endOfWeek->format('d/m/Y');

        return view('salesReport', compact('sales', 'totalRevenue', 'orderCount', 'title', 'subtitle'));
    }

    /**
     * Reporte Mensual de Ventas.
     */
    public function monthly()
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $sales = SaleModel::where('status', 'Finalizado')
            ->whereBetween('date', [$startOfMonth, $endOfMonth])
            ->get();

        $totalRevenue = $sales->sum('total');
        $orderCount = $sales->count();
        $title = "Reporte Mensual";
        $subtitle = Carbon::now()->translatedFormat('F Y');

        return view('salesReport', compact('sales', 'totalRevenue', 'orderCount', 'title', 'subtitle'));
    }

    /**
     * Reporte Anual de Ventas.
     */
    public function annual()
    {
        $startOfYear = Carbon::now()->startOfYear();
        $endOfYear = Carbon::now()->endOfYear();

        $sales = SaleModel::where('status', 'Finalizado')
            ->whereBetween('date', [$startOfYear, $endOfYear])
            ->get();

        $totalRevenue = $sales->sum('total');
        $orderCount = $sales->count();
        $title = "Reporte Anual";
        $subtitle = Carbon::now()->format('Y');

        return view('salesReport', compact('sales', 'totalRevenue', 'orderCount', 'title', 'subtitle'));
    }
}
