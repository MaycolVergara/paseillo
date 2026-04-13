<?php

namespace App\Http\Controllers;

use App\Models\SaleModel;
use App\Models\SaleDetailModel;
use App\Models\ProductModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleReportController extends Controller
{
    /**
     * Reporte Semanal de Ventas (Dashboard Visual).
     */
    public function weekly()
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        // 1. Datos para el gráfico (Día por día de la semana actual)
        $chartLabels = [];
        $chartData = [];
        for ($i = 0; $i < 7; $i++) {
            $date = $startOfWeek->copy()->addDays($i);
            $chartLabels[] = $date->translatedFormat('D d');
            $chartData[] = SaleModel::where('status', 'Finalizado')
                ->whereDate('date', $date)
                ->sum('total');
        }

        // 2. Métricas KPI
        $sales = SaleModel::where('status', 'Finalizado')
            ->whereBetween('date', [$startOfWeek, $endOfWeek])
            ->get();

        $totalRevenue = $sales->sum('total');
        $orderCount = $sales->count();
        $avgTicket = $orderCount > 0 ? $totalRevenue / $orderCount : 0;

        // 3. Top Producto del periodo
        $topProduct = DB::table('sale_details')
            ->join('sales', 'sale_details.sale_id', '=', 'sales.id')
            ->join('products', 'sale_details.product_id', '=', 'products.id')
            ->select('products.name', DB::raw('SUM(sale_details.quantity) as total_quantity'))
            ->where('sales.status', 'Finalizado')
            ->whereBetween('sales.date', [$startOfWeek, $endOfWeek])
            ->groupBy('products.id', 'products.name')
            ->orderByDesc('total_quantity')
            ->first();

        $title = "Dashboard Semanal";
        $subtitle = $startOfWeek->format('d/m') . ' al ' . $endOfWeek->format('d/m/Y');

        return view('salesReport', compact('chartLabels', 'chartData', 'totalRevenue', 'orderCount', 'avgTicket', 'topProduct', 'title', 'subtitle'));
    }

    /**
     * Reporte Mensual de Ventas (Dashboard Visual).
     */
    public function monthly()
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        // 1. Datos para el gráfico (Agrupado por días del mes)
        $chartLabels = [];
        $chartData = [];
        $daysInMonth = Carbon::now()->daysInMonth;
        for ($i = 1; $i <= $daysInMonth; $i++) {
            $date = $startOfMonth->copy()->day($i);
            $chartLabels[] = $i;
            $chartData[] = SaleModel::where('status', 'Finalizado')
                ->whereDate('date', $date)
                ->sum('total');
        }

        // 2. Métricas KPI
        $sales = SaleModel::where('status', 'Finalizado')
            ->whereBetween('date', [$startOfMonth, $endOfMonth])
            ->get();

        $totalRevenue = $sales->sum('total');
        $orderCount = $sales->count();
        $avgTicket = $orderCount > 0 ? $totalRevenue / $orderCount : 0;

        // 3. Top Producto
        $topProduct = DB::table('sale_details')
            ->join('sales', 'sale_details.sale_id', '=', 'sales.id')
            ->join('products', 'sale_details.product_id', '=', 'products.id')
            ->select('products.name', DB::raw('SUM(sale_details.quantity) as total_quantity'))
            ->where('sales.status', 'Finalizado')
            ->whereBetween('sales.date', [$startOfMonth, $endOfMonth])
            ->groupBy('products.id', 'products.name')
            ->orderByDesc('total_quantity')
            ->first();

        $title = "Dashboard Mensual";
        $subtitle = Carbon::now()->translatedFormat('F Y');

        return view('salesReport', compact('chartLabels', 'chartData', 'totalRevenue', 'orderCount', 'avgTicket', 'topProduct', 'title', 'subtitle'));
    }

    /**
     * Reporte Anual de Ventas (Dashboard Visual).
     */
    public function annual()
    {
        $startOfYear = Carbon::now()->startOfYear();
        $endOfYear = Carbon::now()->endOfYear();

        // 1. Datos para el gráfico (Mes a mes)
        $chartLabels = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
        $chartData = [];
        for ($i = 1; $i <= 12; $i++) {
            $chartData[] = SaleModel::where('status', 'Finalizado')
                ->whereMonth('date', $i)
                ->whereYear('date', Carbon::now()->year)
                ->sum('total');
        }

        // 2. Métricas KPI
        $sales = SaleModel::where('status', 'Finalizado')
            ->whereBetween('date', [$startOfYear, $endOfYear])
            ->get();

        $totalRevenue = $sales->sum('total');
        $orderCount = $sales->count();
        $avgTicket = $orderCount > 0 ? $totalRevenue / $orderCount : 0;

        // 3. Top Producto
        $topProduct = DB::table('sale_details')
            ->join('sales', 'sale_details.sale_id', '=', 'sales.id')
            ->join('products', 'sale_details.product_id', '=', 'products.id')
            ->select('products.name', DB::raw('SUM(sale_details.quantity) as total_quantity'))
            ->where('sales.status', 'Finalizado')
            ->whereBetween('sales.date', [$startOfYear, $endOfYear])
            ->groupBy('products.id', 'products.name')
            ->orderByDesc('total_quantity')
            ->first();

        $title = "Dashboard Anual";
        $subtitle = Carbon::now()->format('Y');

        return view('salesReport', compact('chartLabels', 'chartData', 'totalRevenue', 'orderCount', 'avgTicket', 'topProduct', 'title', 'subtitle'));
    }
}
