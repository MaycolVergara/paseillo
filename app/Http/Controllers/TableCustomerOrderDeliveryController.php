<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\SaleModel;
use App\Models\SaleDetailModel;
use App\Models\TableDeliveryModel;
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
            compact('products', 'categories', 'saleDetails', 'overallTotal', 'id'));
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
            'customization' => 'nullable|string'
        ]);

        $product = ProductModel::find($request->product_id);
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
            $currentTable->serving_user_id = Auth::user()->id;
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

            $table = TableDeliveryModel::find($table_id);
            if ($table) {
                $table->status = 'disponible';
                $table->serving_user_id = null;
                $table->save();
            }
        }
        return redirect('/dashboard/customerTableDelyveryView')->with('success', 'Pedido delivery finalizado');
    }
}
