<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Product;
use App\Models\Category;
use Carbon\Carbon;
use App\Models\Table;
use App\Models\TableDelivery;
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

        // 4. Arma el ranking del Top Ventas por CATEGORÍA
        $categoryTotals = [];
        foreach ($detailsToday as $detail) {
            $product = $detail->product;
            if (!$product) continue;

            $category = $product->category;
            $catName = $category ? $category->name : 'Otros';
            $catId = $category ? $category->id : 0;

            if (!isset($categoryTotals[$catId])) {
                $categoryTotals[$catId] = ['name' => $catName, 'quantity' => 0];
            }
            $categoryTotals[$catId]['quantity'] += $detail->quantity;
        }

        // Ordena por cantidad y toma los top 5
        usort($categoryTotals, fn($a, $b) => $b['quantity'] - $a['quantity']);
        $categoryTotals = array_slice($categoryTotals, 0, 5);

        $topProducts = [];
        $maxQuantity = !empty($categoryTotals) ? $categoryTotals[0]['quantity'] : 1;

        foreach ($categoryTotals as $cat) {
            $catNameLow = strtolower($cat['name']);

            $emoji = '🍽️';
            $bgColor = 'from-gray-400 to-gray-300';
            if (str_contains($catNameLow, 'pizza')) { $emoji = '🍕'; $bgColor = 'from-red-500 to-orange-400'; }
            elseif (str_contains($catNameLow, 'hamburguesa') || str_contains($catNameLow, 'burger')) { $emoji = '🍔'; $bgColor = 'from-orange-400 to-amber-400'; }
            elseif (str_contains($catNameLow, 'bebida') || str_contains($catNameLow, 'gaseosa')) { $emoji = '🥤'; $bgColor = 'from-blue-400 to-cyan-400'; }
            elseif (str_contains($catNameLow, 'krispy') || str_contains($catNameLow, 'pollo')) { $emoji = '🍗'; $bgColor = 'from-orange-500 to-red-500'; }
            elseif (str_contains($catNameLow, 'salchipapa') || str_contains($catNameLow, 'papas')) { $emoji = '🍟'; $bgColor = 'from-yellow-400 to-amber-500'; }

            $topProducts[] = (object)[
                'name' => $cat['name'],
                'quantity' => $cat['quantity'],
                'emoji' => $emoji,
                'colorFondo' => $bgColor,
                'percentage' => ($cat['quantity'] / $maxQuantity) * 100
            ];
        }

        // Salón: Pagos en efectivo
        $cashPayment = $salesToday->where('payment_method', 'cash')->sum('total');

        // Delivery/Yape: Pagos por yape
        $yapePayment = $salesToday->where('payment_method', 'yape')->sum('total');

        // Tarjeta: Pagos con tarjeta
        $cardPayment = $salesToday->where('payment_method', 'card')->sum('total');



        // 6. Carga el estado de las mesas
        $tables = Table::where('status', '!=','mesasNoExistentes')
            ->orderBy('table_number', 'asc')->get();

        $tableDelivery=TableDelivery::where('status', '!=','deliveryNoExistente')
             ->orderBy('table_number', 'asc')->get();

        return view('index', compact(
            'totalDay', 'ordersToday',
            'pizzasSold', 'burgersSold', 'drinksSold', 'krispySold', 'salchipapasSold',
            'topProducts', 'tables','tableDelivery', 'cashPayment', 'yapePayment', 'cardPayment',
        ));
    }
}
