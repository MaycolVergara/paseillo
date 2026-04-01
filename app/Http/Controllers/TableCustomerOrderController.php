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
    /**
     * Carga la vista de la mesa seleccionada.
     * Busca si hay una venta pendiente y trae los productos con sus nombres.
     */
    public function index($id)
    {
        $products = Product::all();
        $categories = Category::all();

        $activeSale = Sale::where('table_id', $id)
            ->where('status', 'Pending')
            ->first();

        if ($activeSale) {
            $saleDetails = SaleDetail::with('product')->where('sale_id', $activeSale->id)->get();
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

        $product = Product::find($request->product_id);
        $unit_price = $product->price;
        $subtotal = $unit_price * $request->quantity;

        $sale = Sale::where('table_id', $table_id)
            ->where('status', 'Pending')
            ->first();

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

        $detail = new SaleDetail();
        $detail->sale_id = $sale->id;
        $detail->product_id = $request->product_id;
        $detail->quantity = $request->quantity;
        $detail->unit_price = $unit_price;
        $detail->subtotal = $subtotal;
        $detail->customization = $request->customization;
        $detail->save();

        $sale->total = SaleDetail::where('sale_id', $sale->id)->sum('subtotal');
        $sale->save();

        $currentTable = Table::find($table_id);
        if ($currentTable) {
            $currentTable->status = 'ocupado';
            $currentTable->serving_user_id = Auth::user()->id;
            $currentTable->save();
        }

        return redirect()->back()->with('success', 'Product added to the table');
    }

    /**
     * Prepara la información para imprimir la boleta o el pre-ticket.
     * Muestra el resumen de lo consumido antes de cerrar la cuenta.
     */
    public function generateReceipt($table_id)
    {
        $sale = Sale::where('table_id', $table_id)->where('status', 'Pending')->first();

        if (!$sale) {
            return redirect()->back()->with('error', 'No orders to generate receipt.');
        }

        $saleDetails = SaleDetail::with('product')->where('sale_id', $sale->id)->get();
        $products = Product::all();

        return view('issueReceipt',
            compact('sale', 'saleDetails', 'products'));
    }

    /**
     * Finaliza la venta, guarda el método de pago y libera la mesa.
     * La mesa vuelve a estar "disponible" para nuevos clientes.
     */
    public function finalizeSale(Request $request, $table_id)
    {
        $sale = Sale::where('table_id', $table_id)->where('status', 'Pending')->first();

        if ($sale) {
            $sale->status = 'Finalizado';
            $sale->payment_method = $request->input('payment_method', 'Cash');
            $sale->save();

            $table = Table::find($table_id);
            if ($table) {
                $table->status = 'disponible';
                $table->serving_user_id = null;
                $table->save();
            }
        }
        return redirect('/dashboard/tableView')->with('success', 'Sale finalized and table cleared');
    }

    /**
     * Elimina un producto específico de la orden si el cliente se arrepiente.
     * Resta el valor del producto del total general de la mesa.
     */
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
