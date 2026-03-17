<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ventas;
use App\Models\DetalleVentas;
use App\Models\Productos;
use App\Models\Categoria;
use Carbon\Carbon;
use App\Models\Mesas;

class DashboardController extends Controller
{
    public function index()
    {
        $hoy = Carbon::today();

        // 1. Dinero total y Ventas de hoy
        $ventasHoy = Ventas::where('estado', 'Finalizado')->whereDate('fecha', $hoy)->get();
        $totalDia = $ventasHoy->sum('total');
        $pedidosHoy = $ventasHoy->count();

        // 2. Detalles de hoy
        $ventasHoyIds = $ventasHoy->pluck('id_venta');
        $detallesHoy = DetalleVentas::whereIn('id_venta', $ventasHoyIds)->get();

        // 3. Contadores de las tarjetas superiores
        $pizzasVendidas = 0;
        $hamburguesasVendidas = 0;
        $gaseosasVendidas = 0;
        $krispyVendidos = 0;
        $salchipapasVendidas = 0;

        foreach ($detallesHoy as $detalle) {
            $producto = Productos::find($detalle->id_producto);
            if ($producto) {
                $categoria = Categoria::find($producto->id_categoria);
                $nombreCat = $categoria ? strtolower($categoria->nombre_categoria) : strtolower($producto->nombre_producto);

                if (str_contains($nombreCat, 'pizza')) {
                    $pizzasVendidas += $detalle->cantidad;
                } elseif (str_contains($nombreCat, 'hamburguesa') || str_contains($nombreCat, 'burger')) {
                    $hamburguesasVendidas += $detalle->cantidad;
                } elseif (str_contains($nombreCat, 'bebida') || str_contains($nombreCat, 'gaseosa') || str_contains($nombreCat, 'refresco')) {
                    $gaseosasVendidas += $detalle->cantidad;
                } elseif (str_contains($nombreCat, 'krispy') || str_contains($nombreCat, 'pollo') || str_contains($nombreCat, 'broaster')) {
                    $krispyVendidos += $detalle->cantidad;
                } elseif (str_contains($nombreCat, 'salchipapa') || str_contains($nombreCat, 'papas')) {
                    $salchipapasVendidas += $detalle->cantidad;
                }
            }
        }

        //  NUEVO: 4. Calculamos el Top 5 de los "Más Vendidos"
        // Agrupamos por producto, sumamos cantidades y ordenamos de mayor a menor
        $agrupados = $detallesHoy->groupBy('id_producto')->map(function ($row) {
            return $row->sum('cantidad');
        })->sortDesc()->take(5); // Solo sacamos los 5 mejores

        $topProductos = [];
        $maxCantidad = $agrupados->first() ?? 1; // Para que el más vendido llene la barra al 100%

        foreach ($agrupados as $id_producto => $cantidad) {
            $producto = Productos::find($id_producto);
            if ($producto) {
                $categoria = Categoria::find($producto->id_categoria);
                $nombreCat = $categoria ? strtolower($categoria->nombre_categoria) : strtolower($producto->nombre_producto);

                // Asignamos el emoji y el color de la barra según el tipo de comida
                $emoji = '🍽️';
                $colorFondo = 'from-gray-400 to-gray-300';
                if (str_contains($nombreCat, 'pizza')) {
                    $emoji = '🍕';
                    $colorFondo = 'from-red-500 to-orange-400';
                } elseif (str_contains($nombreCat, 'hamburguesa') || str_contains($nombreCat, 'burger')) {
                    $emoji = '🍔';
                    $colorFondo = 'from-orange-400 to-amber-400';
                } elseif (str_contains($nombreCat, 'bebida') || str_contains($nombreCat, 'gaseosa')) {
                    $emoji = '🥤';
                    $colorFondo = 'from-blue-400 to-cyan-400';
                } elseif (str_contains($nombreCat, 'krispy') || str_contains($nombreCat, 'pollo')) {
                    $emoji = '🍗';
                    $colorFondo = 'from-orange-500 to-red-500';
                } elseif (str_contains($nombreCat, 'salchipapa') || str_contains($nombreCat, 'papas')) {
                    $emoji = '🍟';
                    $colorFondo = 'from-yellow-400 to-amber-500';
                }

                $topProductos[] = (object)[
                    'nombre' => $producto->nombre_producto,
                    'cantidad' => $cantidad,
                    'emoji' => $emoji,
                    'colorFondo' => $colorFondo,
                    'porcentaje' => ($cantidad / $maxCantidad) * 100
                ];
            }
        }

        $hoy=Carbon::today();
        $pagoEfectivo = Ventas::where('estado', 'Finalizado')->whereDate('fecha', $hoy)->where('metodo_pago', 'Efectivo')->sum('total');
        $pagoYape = Ventas::where('estado', 'Finalizado')->whereDate('fecha', $hoy)->whereIn('metodo_pago', ['Yape', 'Plin'])->sum('total');
        $pagoTarjeta = Ventas::where('estado', 'Finalizado')->whereDate('fecha', $hoy)->where('metodo_pago', 'Tarjeta')->sum('total');

        $mesas = Mesas::orderBy('numero_mesa', 'asc')->get();
        // 5. Enviamos todo a la vista (¡Incluimos $topProductos!)
        return view('index', compact(
            'totalDia', 'pedidosHoy',
            'pizzasVendidas', 'hamburguesasVendidas', 'gaseosasVendidas', 'krispyVendidos', 'salchipapasVendidas',
            'topProductos', 'mesas','pagoEfectivo', 'pagoYape', 'pagoTarjeta'
        ));
    }


}
