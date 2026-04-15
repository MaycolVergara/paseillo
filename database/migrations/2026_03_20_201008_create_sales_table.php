<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();

            // 1. Relación con el cliente (Colocado aquí arriba directamente)
            $table->unsignedBigInteger('customer_id')->nullable();

            $table->dateTime('date')->useCurrent();
            $table->decimal('total', 10, 2)->default(0.00);

            $table->unsignedInteger('table_delivery_id')->nullable();
            $table->unsignedInteger('table_id')->nullable();

            $table->integer('table_number')->nullable();
            $table->string('status', 20)->default('open');
            $table->enum('payment_method', ['cash', 'card', 'yape'])->default('cash');

            // 2. Tipo de comprobante (Ticket, Boleta, Factura) -> Por defecto será 'ticket'
            $table->enum('receipt_type', ['ticket', 'receipt', 'invoice'])->default('ticket');

            // 3. Formato de impresión (Detallado o Por Consumo) -> Por defecto será 'detailed'
            $table->enum('print_format', ['detailed', 'consumption'])->default('detailed');

            // RELACIONES
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Esta es la llave foránea que une la venta con el cliente
            $table->foreign('customer_id')->references('id')->on('customer_ballot')->onDelete('set null');

            $table->foreign('table_id')->references('id')->on('tables');
            $table->foreign('table_delivery_id')->references('id')->on('tables_delivery')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
