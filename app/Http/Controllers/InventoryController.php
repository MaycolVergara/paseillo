<?php

namespace App\Http\Controllers;

use App\Models\InventoryEntryModel;
use App\Models\StoreModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    /**
     * Muestra la lista de stock y el historial de ingresos.
     */
    public function index()
    {
        $supplies = StoreModel::orderBy('name', 'asc')->get();
        $entries = InventoryEntryModel::with('supply')->orderBy('entry_date', 'desc')->paginate(10);
        
        return view('inventoryManagement', compact('supplies', 'entries'));
    }

    /**
     * Registra un nuevo ingreso de mercadería.
     */
    public function storeEntry(Request $request)
    {
        $request->validate([
            'store_id' => 'required|exists:stores,id',
            'quantity' => 'required|numeric|min:0.01',
            'entry_date' => 'required|date',
            'notes' => 'nullable|string|max:500',
        ]);

        try {
            DB::beginTransaction();

            // 1. Crear el registro de entrada
            InventoryEntryModel::create($request->all());

            // 2. Actualizar el stock actual en la tabla principal
            $supply = StoreModel::findOrFail($request->store_id);
            $supply->current_stock += $request->quantity;
            $supply->save();

            DB::commit();

            return redirect()->back()->with('success', "Ingreso registrado: {$request->quantity} de {$supply->name} añadidos al almacén.");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Ocurrió un error al registrar el ingreso: ' . $e->getMessage());
        }
    }

    /**
     * Registra un nuevo tipo de insumo (Pan, Leche, etc).
     */
    public function storeSupply(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:stores,name',
            'current_stock' => 'required|numeric|min:0',
            'minimum_stock' => 'required|numeric|min:0',
        ]);

        StoreModel::create($request->all());

        return redirect()->back()->with('success', 'Nuevo insumo registrado correctamente.');
    }
}
