<?php

namespace App\Http\Controllers;

use App\Models\TableDeliveryModel;
use Illuminate\Http\Request;

class TablesDeliveryController extends Controller
{
    // Muestra el panel con los botones de todas las mesas de delivery
    public function index()
    {
        $table_config = TableDeliveryModel::where('status', '!=', 'deliveryNoExistentes')
            ->orderBy('table_number', 'asc')->get();
        $table_view = TableDeliveryModel::all();
        return view('customerTableDelyveryView', compact('table_config', 'table_view'));
    }

    // Abre el formulario para que el admin diga cuántas mesas de delivery quiere hoy
    public function viewTableForm()
    {
        $table_config = TableDeliveryModel::where('status', '!=', 'deliveryNoExistentes')
            ->orderBy('table_number', 'asc')
            ->get();
        $table_view = TableDeliveryModel::all();
        return view('customerTableDelyveryRegistration', compact('table_config', 'table_view'));
    }

    // La lógica que crea o "apaga" mesas según la cantidad que elijas
    public function store(Request $request)
    {
        $newQuantity = (int)$request->input('quantityDelivery');
        $currentTotal = TableDeliveryModel::count();

        // 🛡️ BLOQUEO DE SEGURIDAD: Si hay un pedido abierto (ocupado), no deja mover nada
        $hayGenteComiendo = TableDeliveryModel::where('status', 'ocupado')->exists();

        if ($hayGenteComiendo) {
            return redirect()->back()->with('error',
                '¡Atención! No puedes modificar el salón porque hay mesas con pedidos activos.');
        }

        // SI NO HAY PEDIDOS ACTIVOS, ACTUALIZA:
        if ($newQuantity > $currentTotal) {
            // Activa las que estaban apagadas y crea las que faltan para llegar al nuevo total
            TableDeliveryModel::where('table_number', '<=', $currentTotal)
                ->where('status', 'deliveryNoExistentes')
                ->update(['status' => 'disponible']);

            for ($i = $currentTotal + 1; $i <= $newQuantity; $i++) {
                TableDeliveryModel::create([
                    'table_number' => $i,
                    'status' => 'disponible'
                ]);
            }
        } elseif ($newQuantity < $currentTotal) {
            // Si quieres menos, las que sobran pasan a "deliveryNoExistentes" (se esconden)
            TableDeliveryModel::where('table_number', '<=', $newQuantity)
                ->update(['status' => 'disponible']);

            TableDeliveryModel::where('table_number', '>', $newQuantity)
                ->update(['status' => 'deliveryNoExistentes']);
        }

        return redirect('/dashboard/customerTableDelyveryRegistration')->with('success', 'Salón de Paseillo actualizado con éxito.');
    }
}
