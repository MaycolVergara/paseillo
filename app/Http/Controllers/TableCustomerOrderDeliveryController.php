<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\SaleModel;
use App\Models\SaleDetailModel;
use App\Models\TableDeliveryModel;
use App\Models\StoreModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TableCustomerOrderDeliveryController extends Controller
{
    /**
     * Carga la vista del pedido delivery seleccionado.
     * Busca si hay una venta pendiente y trae los productos con sus nombres.
     */
    public function index($id)
    {
        $products = ProductModel::all();
        $categories = CategoryModel::all();

        $activeSale = SaleModel::where('table_delivery_id', $id)
            ->where('status', 'Pending')
            ->first();

        if ($activeSale) {
            $saleDetails = SaleDetailModel::with('product')->where('sale_id', $activeSale->id)->get();
            $overallTotal = $activeSale->total;
        } else {
            $saleDetails = collect();
            $overallTotal = 0;
        }

        return view('tableOrderDetailsDelyvery',
            compact('products', 'categories', 'saleDetails', 'overallTotal', 'id', 'activeSale'));
    }

    /**
     * Registra un producto en el pedido delivery.
     * Si no hay venta pendiente, crea una nueva y marca el slot como "ocupado".
     */
    public function saveOrder(Request $request, $table_id)
    {
        $request->validate([
            'product_id' => 'required',
            'quantity' => 'required|integer|min:1',
            'customization' => 'nullable|string',
            'customer_phone' => 'nullable|string',
            'delivery_address' => 'nullable|string|max:255'
        ]);

        $product = ProductModel::with('category')->find($request->product_id);
        
        // Verificación de stock antes de registrar la venta delivery
        $storeId = $product->stores_id ?? ($product->category ? $product->category->stores_id : null);
        if ($storeId) {
            $store = StoreModel::find($storeId);
            if ($store && $request->quantity > $store->current_stock) {
                return redirect()->back()->with('error', "No tienes suficiente insumo para hacer esta venta. Stock actual de {$store->name}: {$store->current_stock}");
            }
        }

        $unit_price = $product->price;
        $subtotal = $unit_price * $request->quantity;

        $sale = SaleModel::where('table_delivery_id', $table_id)
            ->where('status', 'Pending')
            ->first();

        if (!$sale) {
            $tableInfo = TableDeliveryModel::find($table_id);

            $sale = new SaleModel();
            $sale->user_id = Auth::user()->id;
            $sale->table_delivery_id = $table_id;
            $sale->table_number = $tableInfo ? $tableInfo->table_number : $table_id;
            $sale->date = now();
            $sale->status = 'Pending';
            $sale->total = 0;
            $sale->customer_phone = $request->customer_phone;
            $sale->delivery_address = $request->delivery_address;
            $sale->save();
        } else {
            // Si ya existe la venta, actualizamos los datos del cliente si se enviaron
            if ($request->has('customer_phone')) $sale->customer_phone = $request->customer_phone;
            if ($request->has('delivery_address')) $sale->delivery_address = $request->delivery_address;
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

        $currentTable = TableDeliveryModel::find($table_id);
        if ($currentTable) {
            $currentTable->status = 'ocupado';
            $currentTable->save();
        }

        return redirect()->back()->with('success', 'Producto agregado al pedido delivery');
    }


    /**
     * Finaliza la venta delivery, guarda el método de pago y libera el slot.
     */
    public function finalizeSale(Request $request, $table_id)
    {
        $sale = SaleModel::where('table_delivery_id', $table_id)->where('status', 'Pending')->first();

        if ($sale) {
            $sale->status = 'Finalizado';
            $sale->payment_method = $request->input('payment_method', 'cash');
            $sale->save();

            // --- LOGICA DE DESCUENTO DE STOCK INTELIGENTE ---
            $details = SaleDetailModel::with('product.category')->where('sale_id', $sale->id)->get();
            foreach ($details as $detail) {
                $storeId = null;

                // 1. Prioridad: Vínculo directo del producto
                if ($detail->product && $detail->product->stores_id) {
                    $storeId = $detail->product->stores_id;
                } // 2. Fallback: Vínculo de la categoría
                elseif ($detail->product && $detail->product->category && $detail->product->category->stores_id) {
                    $storeId = $detail->product->category->stores_id;
                }

                if ($storeId) {
                    $store = StoreModel::find($storeId);
                    if ($store) {
                        $store->decrement('current_stock', $detail->quantity);
                    }
                }
            }
            // ------------------------------------------------

            $table = TableDeliveryModel::find($table_id);
            if ($table) {
                $table->status = 'disponible';
                $table->save();
            }
        }
        return redirect('/dashboard/customerTableDelyveryView')->with('success', 'Pedido delivery finalizado');
    }

    /**
     * Prepara la información para imprimir la boleta o el pre-ticket del DELIVERY.
     */
    public function generateReceipt($id)
    {
        $sale = SaleModel::where('table_delivery_id', $id)->where('status', 'Pending')->first();

        if (!$sale) {
            return redirect()->back();
        }

        $saleDetails = SaleDetailModel::with('product')->where('sale_id', $sale->id)->get();

        return view('issueReceitDelivery', compact('sale', 'saleDetails', 'id'));
    }
}
