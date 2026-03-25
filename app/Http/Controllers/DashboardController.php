<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale; // Antes Ventas
use App\Models\SaleDetail; // Antes DetalleVentas
use App\Models\Product; // Antes Productos
use App\Models\Category; // Antes Categoria
use Carbon\Carbon;
use App\Models\Table; // Antes Mesas

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        // 1. Dinero total y Ventas de hoy
        // Cambiamos 'estado' por 'status' y 'fecha' por 'date'
        $salesToday = Sale::where('status', 'Finalizado')->whereDate('date', $today)->get();
        $totalDay = $salesToday->sum('total');
        $ordersToday = $salesToday->count();

        // 2. Detalles de hoy
        $salesTodayIds = $salesToday->pluck('id'); // Antes id_venta
        $detailsToday = SaleDetail::whereIn('sale_id', $salesTodayIds)->get(); // Antes id_venta

        // 3. Contadores de las tarjetas superiores
        $pizzasSold = 0;
        $burgersSold = 0;
        $drinksSold = 0;
        $krispySold = 0;
        $salchipapasSold = 0;

        foreach ($detailsToday as $detail) {
            $product = Product::find($detail->product_id); // Antes id_producto
            if ($product) {
                $category = Category::find($product->category_id); // Antes id_categoria
                // Cambiamos 'nombre_categoria' por 'name' y 'nombre_producto' por 'name'
                $catName = $category ? strtolower($category->name) : strtolower($product->name);

                if (str_contains($catName, 'pizza')) {
                    $pizzasSold += $detail->quantity;
                } elseif (str_contains($catName, 'hamburguesa') || str_contains($catName, 'burger')) {
                    $burgersSold += $detail->quantity;
                } elseif (str_contains($catName, 'bebida') || str_contains($catName, 'gaseosa') || str_contains($catName, 'refresco')) {
                    $drinksSold += $detail->quantity;
                } elseif (str_contains($catName, 'krispy') || str_contains($catName, 'pollo') || str_contains($catName, 'broaster')) {
                    $krispySold += $detail->quantity;
                } elseif (str_contains($catName, 'salchipapa') || str_contains($catName, 'papas')) {
                    $salchipapasSold += $detail->quantity;
                }
            }
        }

        // 4. Calculamos el Top 5 de los "Más Vendidos"
        $grouped = $detailsToday->groupBy('product_id')->map(function ($row) {
            return $row->sum('quantity');
        })->sortDesc()->take(5);

        $topProducts = [];
        $maxQuantity = $grouped->first() ?? 1;

        foreach ($grouped as $product_id => $quantity) {
            $product = Product::find($product_id);
            if ($product) {
                $category = Category::find($product->category_id);
                $catName = $category ? strtolower($category->name) : strtolower($product->name);

                $emoji = '🍽️';
                $bgColor = 'from-gray-400 to-gray-300';
                if (str_contains($catName, 'pizza')) {
                    $emoji = '🍕';
                    $bgColor = 'from-red-500 to-orange-400';
                } elseif (str_contains($catName, 'hamburguesa') || str_contains($catName, 'burger')) {
                    $emoji = '🍔';
                    $bgColor = 'from-orange-400 to-amber-400';
                } elseif (str_contains($catName, 'bebida') || str_contains($catName, 'gaseosa')) {
                    $emoji = '🥤';
                    $bgColor = 'from-blue-400 to-cyan-400';
                } elseif (str_contains($catName, 'krispy') || str_contains($catName, 'pollo')) {
                    $emoji = '🍗';
                    $bgColor = 'from-orange-500 to-red-500';
                } elseif (str_contains($catName, 'salchipapa') || str_contains($catName, 'papas')) {
                    $emoji = '🍟';
                    $bgColor = 'from-yellow-400 to-amber-500';
                }

                $topProducts[] = (object)[
                    'name' => $product->name,
                    'quantity' => $quantity,
                    'emoji' => $emoji,
                    'colorFondo' => $bgColor,
                    'percentage' => ($quantity / $maxQuantity) * 100
                ];
            }
        }

        // Métodos de pago (Cambiamos 'metodo_pago' por 'payment_method')
        $cashPayment = Sale::where('status', 'Finalizado')->whereDate('date', $today)->where('payment_method', 'Cash')->sum('total');
        $yapePayment = Sale::where('status', 'Finalizado')->whereDate('date', $today)->whereIn('payment_method', ['Yape', 'Plin'])->sum('total');
        $cardPayment = Sale::where('status', 'Finalizado')->whereDate('date', $today)->where('payment_method', 'Card')->sum('total');

        // Mesas (Cambiamos 'numero_mesa' por 'table_number')
        $tables = Table::where('status', '!=','mesasNoExistentes')
            ->orderBy('table_number', 'asc')->get();

        return view('index', compact(
            'totalDay', 'ordersToday',
            'pizzasSold', 'burgersSold', 'drinksSold', 'krispySold', 'salchipapasSold',
            'topProducts', 'tables', 'cashPayment', 'yapePayment', 'cardPayment'
        ));
    }
}
