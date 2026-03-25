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
            $table->dateTime('date')->useCurrent();
            $table->decimal('total', 10, 2)->default(0.00);

            $table->unsignedInteger('table_id')->nullable();
            $table->integer('table_number')->nullable();
            $table->string('status', 20)->default('open');

            $table->unsignedInteger('customer_delivery_id')->nullable();
            $table->decimal('delivery_cost', 8, 2)->default(0);
            $table->string('delivery_status')->default('pendiente');
            $table->string('payment_method', 50)->nullable();

            // RELACIONES (Corregidas para que coincidan)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('table_id')->references('id')->on('tables');

            // AQUÍ ESTABA EL ERROR: Cambié 'tables_delivery' por 'table_delivery'
            $table->foreign('customer_delivery_id')->references('id')->on('table_delivery');

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
