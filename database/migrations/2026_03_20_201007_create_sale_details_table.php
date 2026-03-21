<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sale_details', function (Blueprint $table) {
            $table->increments('id'); // id_detalle
            $table->unsignedInteger('sale_id')->nullable(); // id_venta
            $table->unsignedInteger('product_id')->nullable(); // id_producto
            $table->integer('quantity')->nullable(); // cantidad
            $table->decimal('unit_price', 10, 2)->nullable(); // precio_unitario
            $table->decimal('subtotal', 10, 2)->nullable(); // subtotal
            $table->string('customization', 255)->nullable(); // personalizado

            // Relaciones
            $table->foreign('sale_id')->references('id')->on('sales')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_details');
    }
};
