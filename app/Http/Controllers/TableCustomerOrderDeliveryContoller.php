<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\TableDelivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TableCustomerOrderDeliveryContoller extends Controller
{
    /**
     * Carga la vista del pedido.
     * Si hay una venta "Pending" para ese delivery, trae los productos y el total.
     */
    public function index($id)
    {
        $products = Product::all();
        $categories = Category::all();

        $activeSale = Sale::where('table_delivery_id', $id)
            ->where('status', 'Pending')
            ->first();

        if ($activeSale) {
            $saleDetails = SaleDetail::with('product')->where('sale_id', $activeSale->id)->get();
            $overallTotal = $activeSale->total;
        } else {
            $saleDetails = collect();
            $overallTotal = 0;
        }

        return view('tableOrderDetailsDelyvery', compact('products', 'categories', 'saleDetails', 'overallTotal', 'id'));
    }

    /**
     * Guarda el producto en la cuenta del delivery.
     * Si es el primer producto, crea la venta (Sale).
     * Luego suma el subtotal al total general y pone la unidad en "ocupado".
     */
    public function saveOrder(Request $request, $table_delivery_id)
    {
        $product = Product::find($request->product_id);
        $unit_price = $product->price;
        $subtotal = $unit_price * $request->quantity;

        $sale = Sale::where('table_delivery_id', $table_delivery_id)
            ->where('status', 'Pending')
            ->first();

        if (!$sale) {
            $tableInfo = TableDelivery::find($table_delivery_id);
            $sale = new Sale();
            $sale->table_delivery_id = $table_delivery_id;
            $sale->table_number = $tableInfo ? $tableInfo->table_number_delivery : $table_delivery_id;
            $sale->date = now();
            $sale->status = 'Pending';
            $sale->total = 0;
            $sale->save();
        }

        $detail = new SaleDetail();
        $detail->sale_id = $sale->id;
        $detail->product_id = $request->product_id;
        $detail->quantity = $request->quantity;
        $detail->unit_price = $unit_price;
        $detail->subtotal = $subtotal;
        $detail->customization = $request->customization;
        $detail->save();

        // Recalcula el total de la venta sumando todos sus detalles
        $sale->total = SaleDetail::where('sale_id', $sale->id)->sum('subtotal');
        $sale->save();

        $currentTable = TableDelivery::find($table_delivery_id);
        if ($currentTable) {
            $currentTable->status = 'ocupado';
            $currentTable->save();
        }

        return redirect()->back()->with('success', 'Pedido guardado');
    }

    /**
     * Cierra la cuenta del delivery.
     * Cambia el estado a "Finalizado", guarda el método de pago
     * y libera la unidad poniéndola en "disponible".
     */
    public function finalizeSale(Request $request, $table_delivery_id)
    {
        $sale = Sale::where('table_delivery_id', $table_delivery_id)->where('status', 'Pending')->first();

        if ($sale) {
            $sale->status = 'Finalizado';
            $sale->payment_method = $request->input('payment_method', 'Cash');
            $sale->save();

            $table = TableDelivery::find($table_delivery_id);
            if ($table) {
                $table->status = 'disponible';
                $table->save();
            }
        }

        return redirect('/dashboard/customerTableDelyveryView')->with('success', 'Venta Finalizada');
    }
}
