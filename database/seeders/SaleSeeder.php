<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SaleModel;
use App\Models\SaleDetailModel;
use App\Models\ProductModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SaleSeeder extends Seeder
{
    public function run()
    {
        // 1. Asegurar que tenemos productos REALISTAS de restaurante
        $products = ProductModel::all();
        if ($products->count() < 8) {
            $realisticProducts = [
                ['name' => 'Pizza Hawaiana Familiar', 'price' => 38.00, 'category_id' => 2],
                ['name' => 'Pizza Pepperoni Mediana', 'price' => 26.00, 'category_id' => 2],
                ['name' => 'Hamburguesa Royal con Papas', 'price' => 16.00, 'category_id' => 1],
                ['name' => 'Hamburguesa Clásica', 'price' => 12.00, 'category_id' => 1],
                ['name' => 'Alitas Broaster (6 und)', 'price' => 18.00, 'category_id' => 5],
                ['name' => 'Pollo Krispy (2 Piezas)', 'price' => 15.00, 'category_id' => 3],
                ['name' => 'Salchipapa Mixta Grande', 'price' => 20.00, 'category_id' => 4],
                ['name' => 'Coca Cola 1.5 Litros', 'price' => 10.00, 'category_id' => 6],
                ['name' => 'Chicha Morada Jarra', 'price' => 12.00, 'category_id' => 6],
                ['name' => 'Papas Fritas Porción', 'price' => 8.00, 'category_id' => 4],
            ];

            foreach ($realisticProducts as $p) {
                ProductModel::firstOrCreate(
                    ['name' => $p['name']],
                    [
                        'description' => 'Deliciosa opción preparada al instante.',
                        'price' => $p['price'],
                        'category_id' => $p['category_id']
                    ]
                );
            }
            // Recargamos los productos reales
            $products = ProductModel::all();
        }

        // Limpieza segura de ventas viejas
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        SaleDetailModel::truncate();
        SaleModel::truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        // 2. Generar ventas en una línea de tiempo (últimos 14 días)
        for ($i = 10; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            
            // LÓGICA DE REALISMO EMPRESARIAL (Altos tickets en mesa y delivery)
            if ($date->isWednesday()) {
                // Día Mínimo: Meta S/ 600 a 1000 (Aprox 12 ventas de alto ticket)
                $numberOfSales = rand(10, 15);
            } elseif ($date->isFriday() || $date->isSaturday() || $date->isSunday()) {
                // Día Máximo: Meta S/ 1700 a 2000 (Aprox 33 ventas)
                $numberOfSales = rand(28, 35);
            } else {
                // Día Medio: Meta S/ 1000 a 1700 (Aprox 20 ventas)
                $numberOfSales = rand(18, 25);
            }

            for ($j = 0; $j < $numberOfSales; $j++) {
                // Modos de pago realistas (Yape y cash son más comunes)
                $methods = ['cash', 'cash', 'yape', 'yape', 'yape', 'card'];
                $method = $methods[array_rand($methods)];

                // Crear Venta (Hora realista nocturna 18:00 a 23:59)
                $sale = SaleModel::create([
                    'table_number' => rand(1, 15),
                    'status' => 'Finalizado',
                    'payment_method' => $method,
                    'total' => 0, // Lo actualizamos luego calculando el detalle
                    'date' => $date->copy()->setTime(rand(18, 23), rand(0, 59)),
                    'created_at' => $date->copy()->setTime(rand(18, 23), rand(0, 59)),
                    'updated_at' => $date->copy()->setTime(rand(18, 23), rand(0, 59)),
                ]);

                // Generar de 1 a 4 productos DISTINTOS por pedido
                $numItems = rand(1, 4);
                $saleTotal = 0;
                
                // Evitamos que dos items iguales se inserten como detalles separados en el mismo pedido
                $selectedProducts = $products->random($numItems);

                foreach ($selectedProducts as $prod) {
                    $qty = rand(1, 3); // De 1 a 3 pizzas/hamburguesas iguales
                    $subtotal = $prod->price * $qty;

                    SaleDetailModel::create([
                        'sale_id' => $sale->id,
                        'product_id' => $prod->id,
                        'quantity' => $qty,
                        'unit_price' => $prod->price,
                        'subtotal' => $subtotal,
                        'created_at' => $sale->created_at,
                        'updated_at' => $sale->updated_at,
                    ]);

                    $saleTotal += $subtotal;
                }

                // Guardar la factura con el cobro exacto
                $sale->update(['total' => $saleTotal]);
            }
        }
        // 3. Ocupar mesas en vivo ("Pendientes" actuales) para que el tablero no se vea vacío
        // Primero limpiamos las ocupadas anteriores (opcional, solo para resetear)
        \App\Models\TableModel::where('status', 'ocupado')->update(['status' => 'disponible']);
        \App\Models\TableDeliveryModel::where('status', 'ocupado')->update(['status' => 'disponible']);

        $salonTables = \App\Models\TableModel::where('status', '!=', 'mesasNoExistentes')->inRandomOrder()->take(3)->get();
        foreach ($salonTables as $tbl) {
            $tbl->update(['status' => 'ocupado']);
            $sale = SaleModel::create([
                'table_id' => $tbl->id,
                'table_number' => $tbl->table_number,
                'status' => 'Pending',
                'user_id' => 1, // Admin genérico o cajero
                'total' => 0, 
                'date' => Carbon::now(),
            ]);
            
            $prod = $products->random();
            $qty = rand(1,3);
            SaleDetailModel::create([
                'sale_id' => $sale->id,
                'product_id' => $prod->id,
                'quantity' => $qty,
                'unit_price' => $prod->price,
                'subtotal' => $prod->price * $qty,
            ]);
            $sale->update(['total' => $prod->price * $qty]);
        }

        $deliveryTables = \App\Models\TableDeliveryModel::where('status', '!=', 'deliveryNoExistente')->inRandomOrder()->take(3)->get();
        foreach ($deliveryTables as $tbl) {
            $tbl->update(['status' => 'ocupado']);
            $sale = SaleModel::create([
                'table_delivery_id' => $tbl->id,
                'table_number' => $tbl->table_number, // Para delivery suele ser 1,2,3
                'status' => 'Pending',
                'user_id' => 1,
                'total' => 0,
                'date' => Carbon::now(),
            ]);

            $prod = $products->random();
            $qty = rand(1,2);
            SaleDetailModel::create([
                'sale_id' => $sale->id,
                'product_id' => $prod->id,
                'quantity' => $qty,
                'unit_price' => $prod->price,
                'subtotal' => $prod->price * $qty,
            ]);
            $sale->update(['total' => $prod->price * $qty]);
        }

        $this->command->info("✅ Seeder 100% realista ejecutado. Productos con nombres reales, matemáticas exactas y mesas activas (3 salón, 3 delivery).");
    }
}
