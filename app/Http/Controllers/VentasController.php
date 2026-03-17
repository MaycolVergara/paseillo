<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ventas;

class VentasController extends Controller
{
    public function index(Request $request)
    {
        // 1. Recibimos las fechas del formulario
        $fecha_inicio = $request->input('fecha_inicio');
        $fecha_cierre = $request->input('fecha_cierre');

        // 2. Por defecto, la lista está vacía y el total es 0 (Pantalla limpia)
        $ventas = collect();
        $totalDia = 0;

        // 3. SOLO buscamos en la base de datos si el usuario ingresó ambas fechas
        if ($fecha_inicio && $fecha_cierre) {

            // Reemplazamos la 'T' del input HTML por un espacio para que MySQL lo entienda
            $inicioFiltro = str_replace('T', ' ', $fecha_inicio) . ':00';
            $cierreFiltro = str_replace('T', ' ', $fecha_cierre) . ':59';

            // Usamos whereBetween para buscar entre las dos fechas
            $ventas = Ventas::where('estado', 'Finalizado')
                ->whereBetween('fecha', [$inicioFiltro, $cierreFiltro])
                ->get();

            $totalDia = $ventas->sum('total');
        }
        // Eliminamos el "else" para que no busque automáticamente las ventas de hoy

        return view('ventas', compact('ventas', 'totalDia', 'fecha_inicio', 'fecha_cierre'));
    }
}
