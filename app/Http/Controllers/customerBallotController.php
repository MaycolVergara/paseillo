<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\SaleModel;
use App\Models\SaleDetailModel;
use App\Models\CustomerBallotModel;

class customerBallotController extends Controller
{
    public function index()
    {
        return view('customerBallot');
    }

    public function showBallot($table_id)
    {
        // Obtener la venta pendiente de la mesa
        $sale = SaleModel::where('table_id', $table_id)
            ->where('status', 'Pending')
            ->first();

        if (!$sale) {
            return redirect()->back()->with('error', 'No hay venta pendiente para esta mesa');
        }

        // Obtener los detalles de la venta
        $saleDetails = SaleDetailModel::with('product')
            ->where('sale_id', $sale->id)
            ->get();

        return view('customerBallot', compact('sale', 'saleDetails', 'table_id'));
    }

    public function saveClient(Request $request)
    {
        try {
            // Validar datos
            $request->validate([
                'customer_dni' => 'required|string|size:8',
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
                'customer_dni' => 'required|string|size:8',
                'customer_name' => 'required|string',
                'customer_surname' => 'required|string',
                'customer_phone' => 'nullable|string|max:9',
                'print_format' => 'required|in:detailed,consumption'
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

            // Guardar PDF en storage
            $pdfPath = 'boletas/boleta_' . $customer->dni . '_' . now()->format('YmdHis') . '.pdf';
            Storage::put($pdfPath, $pdf->output());

            // Retornar PDF para descargar
            return $pdf->download('boleta_' . $customer->dni . '_' . now()->format('YmdHis') . '.pdf');

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
                'customer_dni' => 'required|string|size:8',
                'customer_name' => 'required|string',
                'customer_surname' => 'required|string',
                'customer_phone' => 'nullable|string|max:9',
                'print_format' => 'required|in:detailed,consumption'
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

            // 4. Guardar PDF en storage
            $pdfPath = 'boletas/boleta_' . $customer->dni . '_' . now()->format('YmdHis') . '.pdf';
            Storage::put($pdfPath, $pdf->output());

            // 5. Obtener table_id para redirigir
            $table_id = $sale->table_id;

            // 6. Retornar PDF para descargar con redirección en el cliente
            return $pdf->download('boleta_' . $customer->dni . '_' . now()->format('YmdHis') . '.pdf')
                ->header('X-Redirect-To', '/dashboard/tableOrderDetails/' . $table_id);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al guardar: ' . $e->getMessage());
        }
    }

    private function generatePDF($sale, $saleDetails, $customer, $format)
    {
        // Usar TCPDF o similar para generar PDF
        // Por ahora, retornaremos un PDF simple con DomPDF

        $html = $this->generateHTMLBoleta($sale, $saleDetails, $customer, $format);

        $pdf = \PDF::loadHTML($html);
        $pdf->setPaper('A4', 'portrait');

        return $pdf;
    }

    private function generateHTMLBoleta($sale, $saleDetails, $customer, $format)
    {
        $total = $saleDetails->sum('subtotal');

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
                    <span><strong>Subtotal:</strong> S/ " . number_format($total, 2) . "</span>
                </div>
                <div class='totals-row'>
                    <span><strong>IGV (0%):</strong> S/ 0.00</span>
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

    public function searchDni($dni)
    {
        try {
            if (!preg_match('/^[0-9]{8}$/', $dni)) {
                return response()->json([
                    'success' => false,
                    'message' => 'El DNI debe tener 8 dígitos exactos.'
                ]);
            }

            $token = env('RENIEC_API_TOKEN');

            if (!$token) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error de configuración: Token no disponible.'
                ]);
            }

            $response = Http::withoutVerifying()
                ->withToken($token)
                ->timeout(15)
                ->retry(3, 200)
                ->get("https://api.apis.net.pe/v2/reniec/dni?numero=" . $dni);

            if ($response->successful()) {
                $data = $response->json();

                if (!isset($data['nombres']) || !isset($data['apellidoPaterno'])) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Los datos del DNI no tienen el formato esperado.'
                    ]);
                }

                return response()->json([
                    'success' => true,
                    'name' => $data['nombres'] ?? '',
                    'surname' => trim(($data['apellidoPaterno'] ?? '') . ' ' . ($data['apellidoMaterno'] ?? '')),
                    'dni' => $data['numeroDocumento'] ?? $dni
                ]);
            }

            $errorMessage = 'DNI no encontrado';
            if ($response->status() === 401) {
                $errorMessage = 'Token de API inválido o expirado.';
            } elseif ($response->status() === 404) {
                $errorMessage = 'DNI no encontrado en RENIEC.';
            } elseif ($response->status() === 429) {
                $errorMessage = 'Demasiadas solicitudes. Intenta en unos segundos.';
            } elseif ($response->status() >= 500) {
                $errorMessage = 'Servidor de RENIEC no disponible. Intenta más tarde.';
            }

            return response()->json([
                'success' => false,
                'message' => $errorMessage
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ]);
        }
    }
}
