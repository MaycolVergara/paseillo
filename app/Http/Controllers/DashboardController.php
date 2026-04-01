<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Product;
use App\Models\Category;
use Carbon\Carbon;
use App\Models\Table;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        // 1. Saca la cuenta de cuánta plata entró hoy y cuántos pedidos se hicieron
        $salesToday = Sale::where('status', 'Finalizado')->whereDate('date', $today)->get();
        $totalDay = $salesToday->sum('total');
        $ordersToday = $salesToday->count();

        // 2. Trae la lista de todos los platos que se sirvieron hoy
        $salesTodayIds = $salesToday->pluck('id');
        $detailsToday = SaleDetail::whereIn('sale_id', $salesTodayIds)->get();

        // 3. Contadores para las tarjetas: Clasifica si vendiste Pizzas, Burgers, etc.
        $pizzasSold = 0;
        $burgersSold = 0;
        $drinksSold = 0;
        $krispySold = 0;
        $salchipapasSold = 0;

        foreach ($detailsToday as $detail) {
            $product = Product::find($detail->product_id);
            if ($product) {
                $category = Category::find($product->category_id);
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

        // 4. Arma el ranking del Top 5
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
                if (str_contains($catName, 'pizza')) { $emoji = '🍕'; $bgColor = 'from-red-500 to-orange-400'; }
                elseif (str_contains($catName, 'hamburguesa') || str_contains($catName, 'burger')) { $emoji = '🍔'; $bgColor = 'from-orange-400 to-amber-400'; }
                elseif (str_contains($catName, 'bebida') || str_contains($catName, 'gaseosa')) { $emoji = '🥤'; $bgColor = 'from-blue-400 to-cyan-400'; }
                elseif (str_contains($catName, 'krispy') || str_contains($catName, 'pollo')) { $emoji = '🍗'; $bgColor = 'from-orange-500 to-red-500'; }
                elseif (str_contains($catName, 'salchipapa') || str_contains($catName, 'papas')) { $emoji = '🍟'; $bgColor = 'from-yellow-400 to-amber-500'; }

                $topProducts[] = (object)[
                    'name' => $product->name,
                    'quantity' => $quantity,
                    'emoji' => $emoji,
                    'colorFondo' => $bgColor,
                    'percentage' => ($quantity / $maxQuantity) * 100
                ];
            }
        }

        // 5. ✅ CORRECCIÓN DE LA PLATA: SEPARAR SALÓN DE DELIVERY
        // Salón: Todo lo que tenga una mesa física asignada (table_id)
        $cashPayment = $salesToday->whereNotNull('table_id')->sum('total');

        // Delivery: Todo lo que tenga una mesa de delivery asignada (table_delivery_id)
        $yapePayment = $salesToday->whereNotNull('table_delivery_id')->sum('total');

        // Tarjeta: Si quieres seguir viendo pagos con tarjeta (general)
        $cardPayment = $salesToday->where('payment_method', 'Card')->sum('total');

        // 6. Carga el estado de las mesas
        $tables = Table::where('status', '!=','mesasNoExistentes')
            ->orderBy('table_number', 'asc')->get();

        return view('index', compact(
            'totalDay', 'ordersToday',
            'pizzasSold', 'burgersSold', 'drinksSold', 'krispySold', 'salchipapasSold',
            'topProducts', 'tables', 'cashPayment', 'yapePayment', 'cardPayment'
        ));
    }
}
