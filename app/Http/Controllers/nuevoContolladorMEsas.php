<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Table;
use Illuminate\Database\QueryException;

class nuevoContolladorMEsas extends Controller
{
    public function index()
    {
        // Traemos TODAS las mesas para ver el salón completo
        $table_config = Table::where('status', '!=', 'mesasNoExistentes')
            ->orderBy('table_number', 'asc')->get();
        $table_view = Table::all();
        return view('tableView', compact('table_config', 'table_view'));
    }

    public function viewTableForm()
    {
        $table_config = Table::where('status', '!=', 'mesasNoExistentes')
            ->orderBy('table_number', 'asc')
            ->get();
        $table_view = Table::all();
        return view('tableRegistration', compact('table_config', 'table_view'));
    }

    public function store(Request $request)
    {
        $newQuantity = (int)$request->input('quantity');
        $currentTotal = Table::count();

        // 1. EL BLOQUEO TOTAL:
        // Buscamos si existe CUALQUIER mesa con el estado 'ocupado' en todo el sistema
        $hayGenteComiendo = Table::where('status', 'ocupado')->exists();

        if ($hayGenteComiendo) {
            // No importa si quieres poner más o menos mesas, si hay alguien atendido, ERROR.
            return redirect()->back()->with('error',
                '¡Atención! No puedes modificar el salón porque hay mesas con pedidos activos.');
        }

        // 2. SI NO HAY NADIE COMIENDO, PROCEDEMOS A ACTUALIZAR
        if ($newQuantity > $currentTotal) {
            // Subir mesas: Reactivamos las antiguas y creamos las nuevas
            Table::where('table_number', '<=', $currentTotal)
                ->where('status', 'mesasNoExistentes')
                ->update(['status' => 'disponible']);

            for ($i = $currentTotal + 1; $i <= $newQuantity; $i++) {
                Table::create([
                    'table_number' => $i,
                    'status' => 'disponible'
                ]);
            }
        } elseif ($newQuantity < $currentTotal) {
            // Bajar mesas: Las que se quedan pasan a disponible
            Table::where('table_number', '<=', $newQuantity)
                ->update(['status' => 'disponible']);

            // Las que sobran pasan a tu estado especial de 'apagadas'
            Table::where('table_number', '>', $newQuantity)
                ->update(['status' => 'mesasNoExistentes']);
        }

        return redirect('/dashboard/tableRegistration')->with('success', 'Salón de Paseillo actualizado con éxito.');
    }
}
