<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TableCustomerOrderController extends Controller
{
    // Añadimos $id para saber qué mesa estamos abriendo
    public function index($id)
    {
        $products = Product::all();
        $categories = Category::all();

        // 1. Buscamos si la mesa tiene una venta activa (Pending)
        $activeSale = Sale::where('table_id', $id)
            ->where('status', 'Pending')
            ->first();

        // 2. Si tiene venta, traemos sus detalles y el total.
        if ($activeSale) {
            $saleDetails = SaleDetail::where('sale_id', $activeSale->id)->get();
            $overallTotal = $activeSale->total;
        } else {
            $saleDetails = collect();
            $overallTotal = 0;
        }

        return view('tableOrderDetails',
            compact('products', 'categories', 'saleDetails', 'overallTotal', 'id'));
    }

    public function saveOrder(Request $request, $table_id)
    {
        // 1. Validamos
        $request->validate([
            'product_id' => 'required',
            'quantity' => 'required|integer|min:1',
            'customization' => 'nullable|string'
        ]);

        // 2. Buscamos precio real
        $product = Product::find($request->product_id);
        $unit_price = $product->price;
        $subtotal = $unit_price * $request->quantity;

        // 3. Buscamos si la mesa ya tiene una orden "Pending"
        $sale = Sale::where('table_id', $table_id)
            ->where('status', 'Pending')
            ->first();

        // Si no tiene, creamos la Venta
        if (!$sale) {
            $tableInfo = Table::find($table_id);

            $sale = new Sale();
            $sale->table_id = $table_id;
            $sale->table_number = $tableInfo ? $tableInfo->table_number : $table_id;
            $sale->date = now();
            $sale->status = 'Pending';
            $sale->total = 0;
            $sale->save();
        }

        // 4. Guardamos el detalle
        $detail = new SaleDetail();
        $detail->sale_id = $sale->id;
        $detail->product_id = $request->product_id;
        $detail->quantity = $request->quantity;
        $detail->unit_price = $unit_price;
        $detail->subtotal = $subtotal;
        $detail->customization = $request->customization;
        $detail->save();

        // 5. Actualizamos el Total general de la Venta
        $sale->total = SaleDetail::where('sale_id', $sale->id)->sum('subtotal');
        $sale->save();

        // 6. Cambiar el estado de la mesa a 'ocupado' y ASIGNAR MOZO
        $currentTable = Table::find($table_id);
        if ($currentTable) {
            $currentTable->status = 'ocupado'; // Mantengo 'ocupado' como pediste en la migración
            $currentTable->serving_user_id = Auth::user()->id;
            $currentTable->save();
        }

        return redirect()->back()->with('success', 'Product added to the table');
    }

    public function generateReceipt($table_id)
    {
        $sale = Sale::where('table_id', $table_id)->where('status', 'Pending')->first();

        if (!$sale) {
            return redirect()->back()->with('error', 'No orders to generate receipt.');
        }

        $saleDetails = SaleDetail::where('sale_id', $sale->id)->get();
        $products = Product::all();

        return view('issueReceipt', compact('sale', 'saleDetails', 'products'));
    }

    public function finalizeSale(Request $request, $table_id)
    {
        // 1. Buscamos la venta 'Pending'
        $sale = Sale::where('table_id', $table_id)->where('status', 'Pending')->first();

        if ($sale) {
            // 2. Cerramos la cuenta
            $sale->status = 'Finalizado';

            // 3. Guardamos el método de pago
            $sale->payment_method = $request->input('payment_method', 'Cash');
            $sale->save();

            // 4. LIBERAMOS LA MESA
            $table = Table::find($table_id);
            if ($table) {
                $table->status = 'disponible'; // Mantengo 'disponible' como pediste
                $table->serving_user_id = null;
                $table->save();
            }
        }

        return redirect('/dashboard/tableView')->with('success', 'Sale finalized and table cleared');
    }

    public function deleteDetail($detail_id)
    {
        $detail = SaleDetail::find($detail_id);

        if ($detail) {
            $sale = Sale::find($detail->sale_id);

            if ($sale) {
                $sale->total = $sale->total - $detail->subtotal;
                $sale->save();
            }

            $detail->delete();
        }

        return redirect()->back()->with('success', 'Product removed from order');
    }
}
