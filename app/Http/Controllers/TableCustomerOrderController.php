<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\SaleModel;
use App\Models\SaleDetailModel;
use App\Models\TableModel;
use App\Models\StoreModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TableCustomerOrderController extends Controller
{
    /**
     * Carga la vista de la mesa seleccionada.
     * Busca si hay una venta pendiente y trae los productos con sus nombres.
     */
    public function index($id)
    {
        $products = ProductModel::all();
        $categories = CategoryModel::all();

        $activeSale = SaleModel::where('table_id', $id)
            ->where('status', 'Pending')
            ->first();

        if ($activeSale) {
            $saleDetails = SaleDetailModel::with('product')->where('sale_id', $activeSale->id)->get();
            $overallTotal = $activeSale->total;
        } else {
            $saleDetails = collect();
            $overallTotal = 0;
        }

        return view('tableOrderDetails',
            compact('products', 'categories', 'saleDetails', 'overallTotal', 'id'));
    }

    /**
     * Registra un producto en la mesa.
     * Si la mesa está libre, crea la venta nueva y la marca como "ocupado".
     * Registra quién es el mozo que está atendiendo la mesa.
     */
    public function saveOrder(Request $request, $table_id)
    {
        $request->validate([
            'product_id' => 'required',
            'quantity' => 'required|integer|min:1',
            'customization' => 'nullable|string'
        ]);

        $product = ProductModel::find($request->product_id);
        $unit_price = $product->price;
        $subtotal = $unit_price * $request->quantity;

        $sale = SaleModel::where('table_id', $table_id)
            ->where('status', 'Pending')
            ->first();

        if (!$sale) {
            $tableInfo = TableModel::find($table_id);

            $sale = new SaleModel();
            $sale->user_id = Auth::user()->id;
            $sale->table_id = $table_id;
            $sale->table_number = $tableInfo ? $tableInfo->table_number : $table_id;
            $sale->date = now();
            $sale->status = 'Pending';
            $sale->total = 0;
            $sale->save();
        }

        $detail = new SaleDetailModel();
        $detail->sale_id = $sale->id;
        $detail->product_id = $request->product_id;
        $detail->quantity = $request->quantity;
        $detail->unit_price = $unit_price;
        $detail->subtotal = $subtotal;
        $detail->customization = $request->customization;
        $detail->save();

        $sale->total = SaleDetailModel::where('sale_id', $sale->id)->sum('subtotal');
        $sale->save();

        $currentTable = TableModel::find($table_id);
        if ($currentTable) {
            $currentTable->status = 'ocupado';
            $currentTable->serving_user_id = Auth::user()->id;
            $currentTable->save();
        }

        return redirect()->back()->with('success', 'ProductModel added to the table');
    }

    /**
     * Prepara la información para imprimir la boleta o el pre-ticket.
     * Muestra el resumen de lo consumido antes de cerrar la cuenta.
     */
    public function generateReceipt($table_id)
    {
        $sale = SaleModel::where('table_id', $table_id)->where('status', 'Pending')->first();

        if (!$sale) {
            return redirect()->back();
        }

        $saleDetails = SaleDetailModel::with('product')->where('sale_id', $sale->id)->get();
        $products = ProductModel::all();

        return view('issueReceipt',
            compact('sale', 'saleDetails', 'products'));
    }

    /**
     * Finaliza la venta, guarda el método de pago y libera la mesa.
     * La mesa vuelve a estar "disponible" para nuevos clientes.
     */
    public function finalizeSale(Request $request, $table_id)
    {
        $sale = SaleModel::where('table_id', $table_id)->where('status', 'Pending')->first();

        if ($sale) {
            $sale->status = 'Finalizado';
            $sale->payment_method = $request->input('payment_method', 'cash');
            $sale->save();

            // --- LOGICA DE DESCUENTO DE STOCK ---
            $details = SaleDetailModel::with('product')->where('sale_id', $sale->id)->get();
            foreach ($details as $detail) {
                if ($detail->product && $detail->product->stores_id) {
                    $store = StoreModel::find($detail->product->stores_id);
                    if ($store) {
                        $store->decrement('current_stock', $detail->quantity);
                    }
                }
            }
            // ------------------------------------

            $table = TableModel::find($table_id);
            if ($table) {
                $table->status = 'disponible';
                $table->serving_user_id = null;
                $table->save();
            }
        }
        return redirect('/dashboard/tableView')->with('success', 'SaleModel finalized and table cleared');
    }

    /**
     * Elimina un producto específico de la orden si el cliente se arrepiente.
     * Resta el valor del producto del total general de la mesa.
     */
    public function deleteDetail($detail_id)
    {
        $detail = SaleDetailModel::find($detail_id);

        if ($detail) {
            $sale = SaleModel::find($detail->sale_id);

            if ($sale) {
                $sale->total = $sale->total - $detail->subtotal;
                $sale->save();
            }

            $detail->delete();
        }

        return redirect()->back()->with('success', 'ProductModel removed from order');
    }
}
