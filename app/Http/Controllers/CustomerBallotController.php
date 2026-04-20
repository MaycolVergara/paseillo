<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SaleModel;
use App\Models\SaleDetailModel;
use App\Models\CustomerBallotModel;
use Barryvdh\DomPDF\Facade\Pdf;

class CustomerBallotController extends Controller
{
    public function index()
    {      $customer=CustomerBallotModel::all();
        return view('customerList',compact('customer'));
    }

    public function showBallot(Request $request, $table_id)
    {
        try {
            // Detectar si viene de Delivery o Salón
            $isDelivery = $request->query('type') === 'delivery';
            $searchColumn = $isDelivery ? 'table_delivery_id' : 'table_id';

            // Buscamos la venta por la columna correcta
            $sale = SaleModel::where($searchColumn, $table_id)
                ->whereIn('status', ['Pending', 'pending', 'active', 'Active'])
                ->latest()
                ->first();

            if (!$sale) {
                return redirect()->back()->with('error', 'No se encontró una orden activa para esta mesa.');
            }

            // Obtener los detalles de la venta
            $saleDetails = SaleDetailModel::with('product')
                ->where('sale_id', $sale->id)
                ->get();

            return view('customerBallot', compact('sale', 'saleDetails', 'table_id', 'isDelivery'));
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Error al cargar la boleta: ' . $e->getMessage());
        }
    }

    public function reprintBallot($sale_id, Request $request)
    {
        try {
            $sale = SaleModel::findOrFail($sale_id);
            $saleDetails = SaleDetailModel::with('product')
                ->where('sale_id', $sale->id)
                ->get();
            
            $isDelivery = !empty($sale->table_delivery_id);
            $table_id = $isDelivery ? $sale->table_delivery_id : $sale->table_id;
            
            $isReprint = true;
            return view('customerBallot', compact('sale', 'saleDetails', 'table_id', 'isDelivery', 'isReprint'));
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Error al cargar la boleta para re-imprimir: ' . $e->getMessage());
        }
    }

    public function saveClient(Request $request)
    {
        try {
            // Validar datos
            $request->validate([
                'customer_dni' => 'required|string|min:8|max:11',
                'customer_name' => 'required|string',
                'customer_surname' => 'required|string',
                'customer_phone' => 'nullable|string|max:9'
            ]);

            // Guardar o actualizar cliente en tabla customer_ballot
            $customer = CustomerBallotModel::updateOrCreate(
                ['dni' => $request->customer_dni],
                [
                    'name' => $request->customer_name,
                    'surname' => $request->customer_surname,
                    'phone' => $request->customer_phone ?? ''
                ]
            );

            return response()->json([
                'success' => true,
                'message' => 'Cliente guardado correctamente',
                'customer_id' => $customer->id
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al guardar: ' . $e->getMessage()
            ], 500);
        }
    }

    public function generatePdfOnly(Request $request)
    {
        try {
            // Validar datos
            $request->validate([
                'sale_id' => 'required|exists:sales,id',
                'customer_dni' => 'required|string|min:8|max:11',
                'customer_name' => 'required|string',
                'customer_surname' => 'required|string',
                'customer_phone' => 'nullable|string|max:9',
                'print_format' => 'required|in:detailed,consumption,clientes_varios'
            ]);

            // Obtener cliente
            $customer = CustomerBallotModel::where('dni', $request->customer_dni)->first();

            if (!$customer) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cliente no encontrado'
                ], 404);
            }

            // Obtener la venta y sus detalles
            $sale = SaleModel::find($request->sale_id);
            $saleDetails = SaleDetailModel::with('product')
                ->where('sale_id', $sale->id)
                ->get();

            // Generar PDF
            $pdf = $this->generatePDF($sale, $saleDetails, $customer, $request->print_format);

            // Retornar PDF para descargar directamente (sin guardar en disco)
            $filename = 'boleta_' . $customer->dni . '_' . now()->format('YmdHis') . '.pdf';
            return $pdf->download($filename);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al generar PDF: ' . $e->getMessage()
            ], 500);
        }
    }

    public function storeBallot(Request $request)
    {
        try {
            // Validar datos
            $request->validate([
                'sale_id' => 'required|exists:sales,id',
                'customer_dni' => 'required|string|min:8|max:11',
                'customer_name' => 'required|string',
                'customer_surname' => 'required|string',
                'customer_phone' => 'nullable|string|max:9',
                'print_format' => 'required|in:detailed,consumption,clientes_varios'
            ]);

            // 1. Guardar o actualizar cliente en tabla customer_ballot
            $customer = CustomerBallotModel::updateOrCreate(
                ['dni' => $request->customer_dni],
                [
                    'name' => $request->customer_name,
                    'surname' => $request->customer_surname,
                    'phone' => $request->customer_phone ?? ''
                ]
            );

            // 2. Obtener la venta y sus detalles
            $sale = SaleModel::find($request->sale_id);
            $saleDetails = SaleDetailModel::with('product')
                ->where('sale_id', $sale->id)
                ->get();

            // 3. Generar PDF
            $pdf = $this->generatePDF($sale, $saleDetails, $customer, $request->print_format);

            // 4. Obtener table_id y definir redirección
            $isReprint = $request->input('is_reprint') === '1';
            
            if ($isReprint) {
                $redirectUrl = '/dashboard/saleDetails';
            } else {
                $isDelivery = !empty($sale->table_delivery_id);
                $redirectUrl = $isDelivery 
                    ? '/dashboard/tableOrderDetailsDelyvery/' . $sale->table_delivery_id
                    : '/dashboard/tableOrderDetails/' . $sale->table_id;
            }

            // 5. Retornar PDF para descargar directamente (sin guardar en disco)
            $filename = 'boleta_' . $customer->dni . '_' . now()->format('YmdHis') . '.pdf';
            return $pdf->download($filename)
                ->header('X-Redirect-To', $redirectUrl);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al guardar: ' . $e->getMessage());
        }
    }

    private function generatePDF($sale, $saleDetails, $customer, $format)
    {
        // Usar TCPDF o similar para generar PDF
        // Por ahora, retornaremos un PDF simple con DomPDF

        $html = $this->generateHTMLBoleta($sale, $saleDetails, $customer, $format);

        $pdf = Pdf::loadHTML($html);
        $pdf->setPaper('A4', 'portrait');

        return $pdf;
    }

    private function generateHTMLBoleta($sale, $saleDetails, $customer, $format)
    {
        $total = $saleDetails->sum('subtotal');
        $baseImponible = round($total / 1.18, 2);
        $igv = round($total - $baseImponible, 2);

        $productosHTML = '';

        if ($format === 'detailed') {
            // Formato detallado: lista cada producto
            foreach ($saleDetails as $detalle) {
                $productosHTML .= "
                    <tr>
                        <td style='text-align: center; padding: 8px; border-bottom: 1px solid #ddd;'>{$detalle->quantity}</td>
                        <td style='padding: 8px; border-bottom: 1px solid #ddd;'>{$detalle->product->name}</td>
                        <td style='text-align: right; padding: 8px; border-bottom: 1px solid #ddd;'>S/ " . number_format($detalle->unit_price, 2) . "</td>
                        <td style='text-align: right; padding: 8px; border-bottom: 1px solid #ddd;'>S/ " . number_format($detalle->subtotal, 2) . "</td>
                    </tr>
                ";
            }
        } else {
            // Formato por consumo: agrupa por categoría
            $grouped = $saleDetails->groupBy(function ($item) {
                return $item->product->category->name ?? 'Otros';
            });

            foreach ($grouped as $category => $items) {
                $categoryTotal = $items->sum('subtotal');
                $productosHTML .= "
                    <tr style='background-color: #f5f5f5;'>
                        <td colspan='4' style='padding: 8px; font-weight: bold;'>{$category}</td>
                    </tr>
                ";
                foreach ($items as $detalle) {
                    $productosHTML .= "
                        <tr>
                            <td style='text-align: center; padding: 8px;'>{$detalle->quantity}</td>
                            <td style='padding: 8px;'>{$detalle->product->name}</td>
                            <td style='text-align: right; padding: 8px;'>S/ " . number_format($detalle->unit_price, 2) . "</td>
                            <td style='text-align: right; padding: 8px;'>S/ " . number_format($detalle->subtotal, 2) . "</td>
                        </tr>
                    ";
                }
            }
        }

        $html = "
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset='UTF-8'>
            <style>
                body { font-family: Arial, sans-serif; margin: 20px; }
                .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #333; padding-bottom: 10px; }
                .header h1 { margin: 0; font-size: 24px; }
                .header p { margin: 5px 0; font-size: 12px; }
                .info { margin: 15px 0; font-size: 12px; }
                .info-row { display: flex; justify-content: space-between; margin: 5px 0; }
                table { width: 100%; border-collapse: collapse; margin: 15px 0; }
                th { background-color: #f0f0f0; padding: 10px; text-align: left; font-weight: bold; border-bottom: 2px solid #333; }
                .totals { margin-top: 20px; text-align: right; }
                .totals-row { display: flex; justify-content: flex-end; margin: 5px 0; }
                .total-amount { font-size: 18px; font-weight: bold; color: #e30613; }
                .footer { text-align: center; margin-top: 30px; font-size: 11px; color: #666; border-top: 1px solid #ddd; padding-top: 10px; }
            </style>
        </head>
        <body>
            <div class='header'>
                <h1>PASEILLO</h1>
                <p>Pizzas & Burgers</p>
                <p>JR. GERVASIO SANTILLANA 120 - HUANTA - AYACUCHO</p>
            </div>

            <div class='info'>
                <div class='info-row'>
                    <span><strong>Fecha:</strong> " . now()->format('d/m/Y H:i') . "</span>
                    <span><strong>Boleta #:</strong> " . str_pad($sale->id, 6, '0', STR_PAD_LEFT) . "</span>
                </div>
                <div class='info-row'>
                    <span><strong>Cliente:</strong> {$customer->name} {$customer->surname}</span>
                </div>
                <div class='info-row'>
                    <span><strong>DNI:</strong> {$customer->dni}</span>
                </div>
            </div>

            <table>
                <thead>
                    <tr>
                        <th style='width: 10%;'>CANT</th>
                        <th style='width: 50%;'>DESCRIPCIÓN</th>
                        <th style='width: 20%;'>P.U.</th>
                        <th style='width: 20%;'>TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    {$productosHTML}
                </tbody>
            </table>

            <div class='totals'>
                <div class='totals-row'>
                    <span><strong>Base Imponible:</strong> S/ " . number_format($baseImponible, 2) . "</span>
                </div>
                <div class='totals-row'>
                    <span><strong>IGV (18%):</strong> S/ " . number_format($igv, 2) . "</span>
                </div>
                <div class='totals-row total-amount'>
                    <span><strong>TOTAL A PAGAR: S/ " . number_format($total, 2) . "</strong></span>
                </div>
            </div>

            <div class='footer'>
                <p>Gracias por su compra</p>
                <p>Para consultas: " . ($customer->phone ? 'WhatsApp ' . $customer->phone : 'Contactenos') . "</p>
            </div>
        </body>
        </html>
        ";

        return $html;
    }


}
