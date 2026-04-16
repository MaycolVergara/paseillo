<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SaleModel;
use App\Models\SaleDetailModel;
use App\Models\ProductModel;
use App\Models\UserModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SaleSeeder extends Seeder
{
    public function run()
    {
        // Limpiamos ventas previas eliminando primero los hijos para evitar errores de integridad.
        // Usamos delete() en lugar de truncate() para máxima compatibilidad con permisos en la nube (Postgres).
        SaleDetailModel::query()->delete();
        SaleModel::query()->delete();

        $products = ProductModel::all();
        $users = UserModel::all();

        if ($products->isEmpty() || $users->isEmpty()) {
            $this->command->error("Se necesitan productos y usuarios para generar ventas.");
            return;
        }

        $userIds = $users->pluck('id')->toArray();
        $startDate = Carbon::create(2023, 1, 1);
        $endDate = Carbon::now();
        $days = (int) $startDate->diffInDays($endDate);

        $this->command->info("Generando datos históricos masivos (~$days días)...");

        $batchSize = 500;
        $salesBatch = [];
        $detailsBatch = [];

        for ($i = $days; $i >= 0; $i--) {
            $currentDate = Carbon::now()->subDays($i);
            $dailyTotalTarget = 1500;
            $accumulatedTotal = 0;

            while ($accumulatedTotal < $dailyTotalTarget) {
                $isDelivery = rand(1, 10) > 7;
                $saleDateTime = $currentDate->copy()->setTime(rand(12, 22), rand(0, 59));
                
                // Generar de 2 a 5 productos mezclados
                $numItems = rand(2, 5);
                $chosenProducts = $products->random(min($numItems, $products->count()));

                $saleTotal = 0;
                $tempDetails = [];
                
                // Primero calculamos el total de la venta
                foreach ($chosenProducts as $prod) {
                    $qty = rand(1, 3);
                    $subtotal = $prod->price * $qty;
                    $saleTotal += $subtotal;
                    $tempDetails[] = [
                        'product_id' => $prod->id,
                        'quantity' => $qty,
                        'unit_price' => $prod->price,
                        'subtotal' => $subtotal,
                        'created_at' => $saleDateTime,
                        'updated_at' => $saleDateTime,
                    ];
                }

                // Insertar Sale y obtener ID
                $saleId = DB::table('sales')->insertGetId([
                    'user_id' => collect($userIds)->random(),
                    'date' => $saleDateTime,
                    'total' => $saleTotal,
                    'status' => 'Finalizado',
                    'payment_method' => collect(['cash', 'card', 'yape'])->random(),
                    'table_number' => $isDelivery ? null : rand(1, 15),
                    'table_delivery_id' => $isDelivery ? rand(1, 5) : null,
                    'created_at' => $saleDateTime,
                    'updated_at' => $saleDateTime,
                ]);

                // Preparar detalles con el ID real
                foreach ($tempDetails as $detail) {
                    $detail['sale_id'] = $saleId;
                    $detailsBatch[] = $detail;
                }

                $accumulatedTotal += $saleTotal;

                // Insertar detalles en chunks para velocidad
                if (count($detailsBatch) >= $batchSize) {
                    DB::table('sale_details')->insert($detailsBatch);
                    $detailsBatch = [];
                }
            }
        }

        // Insertar detalles restantes
        if (!empty($detailsBatch)) {
            DB::table('sale_details')->insert($detailsBatch);
        }

        $this->command->info("✅ ¡Ventas masivas generadas con éxito!");
    }
}
