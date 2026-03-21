<?php

namespace App\Http\Controllers;

use App\Models\Table; // Antes Mesas
use Illuminate\Http\Request;

class TableConfigController extends Controller // Antes MesasConfigController
{
    // Función para mostrar la vista
    public function index()
    {
        // Cambiamos 'numero_mesa' por 'table_number'
        $table_config = Table::orderBy('table_number', 'asc')->get();
        $table_view = Table::all();

        return view('tableRegistration', compact('table_config', 'table_view')); // Antes mesasRegistros
    }

    // Función que GUARDA en MySQL
    public function store(Request $request)
    {
        // Recibimos la cantidad del input
        $newQuantity = $request->input('quantity');

        // Contamos cuántas mesas hay actualmente
        $currentTotal = Table::count();

        if ($newQuantity > $currentTotal) {
            // Creamos las mesas que faltan
            for ($i = $currentTotal + 1; $i <= $newQuantity; $i++) {
                Table::create([
                    'table_number' => $i,
                    'status'       => 'disponible' // Mantengo 'disponible' porque así lo pediste en la migración
                ]);
            }
        } elseif ($newQuantity < $currentTotal) {
            // Eliminamos las mesas sobrantes
            Table::where('table_number', '>', $newQuantity)->delete();
        }

        // Redirigimos de vuelta a la pantalla
        return redirect('/dashboard/tableRegistration')->with('success', 'Tables updated successfully');
    }
}
