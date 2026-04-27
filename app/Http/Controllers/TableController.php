<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TableModel;
use Illuminate\Database\QueryException;

class TableController extends Controller
{
    /**
     * Carga el mapa de mesas del local.
     * Filtra solo las que están activas para que los mozos vean qué mesa ocupar.
     */
    public function index()
    {
        $table_config = TableModel::where('status', '!=', 'mesasNoExistentes')
            ->orderBy('table_number', 'asc')->get();
        $table_view = TableModel::all();
        return view('tableView', compact('table_config', 'table_view'));
    }

    /**
     * Muestra el formulario para configurar el tamaño del salón.
     * Permite al admin decidir cuántas mesas físicas tiene el restaurante.
     */
    public function viewTableForm()
    {
        $table_config = TableModel::where('status', '!=', 'mesasNoExistentes')
            ->orderBy('table_number', 'asc')
            ->get();
        $table_view = TableModel::all();
        return view('tableRegistration', compact('table_config', 'table_view'));
    }

    /**
     * El motor que suma o resta mesas del local.
     * Tiene el candado de seguridad para no borrar mesas con gente comiendo.
     */
    public function store(Request $request)
    {
        $newQuantity = (int)$request->input('quantity');
        $currentTotal = TableModel::count();

        // 🛡️ SEGURIDAD: Si hay una mesa en "ocupado", el sistema bloquea cualquier cambio.
        $hayGenteComiendo = TableModel::where('status', 'ocupado')->exists();

        if ($hayGenteComiendo) {
            return redirect()->back()->with('error',
                '¡Atención! No puedes modificar el salón porque hay mesas con pedidos activos.');
        }

        // Lógica de actualización si el salón está vacío:
        if ($newQuantity > $currentTotal) {
            // Caso A: Subir mesas. Reactiva las "apagadas" y crea las que falten.
            TableModel::where('table_number', '<=', $currentTotal)
                ->where('status', 'mesasNoExistentes')
                ->update(['status' => 'disponible']);

            for ($i = $currentTotal + 1; $i <= $newQuantity; $i++) {
                TableModel::create([
                    'table_number' => $i,
                    'status' => 'disponible'
                ]);
            }
        } elseif ($newQuantity < $currentTotal) {
            // Caso B: Bajar mesas. Las que sobran se marcan como "mesasNoExistentes".
            TableModel::where('table_number', '<=', $newQuantity)
                ->update(['status' => 'disponible']);

            TableModel::where('table_number', '>', $newQuantity)
                ->update(['status' => 'mesasNoExistentes']);
        }

        return redirect('/dashboard/tableRegistration')->with('success', 'Salón de Paseillo actualizado con éxito.');
    }

    /**
     * Alternar estado de la mesa (disponible / inhabilitada).
     */
    public function toggleStatus($id)
    {
        $table = TableModel::findOrFail($id);

        if ($table->status == 'ocupado') {
            return redirect()->back()->with('error', 'No se puede inhabilitar una mesa que está ocupada.');
        }

        if ($table->status == 'mesasInhabilitada') {
            $table->status = 'disponible';
            $message = 'Mesa habilitada correctamente.';
        } else {
            $table->status = 'mesasInhabilitada';
            $message = 'Mesa inhabilitada correctamente.';
        }

        $table->save();
        return redirect()->back()->with('success', $message);
    }
}
