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
        Schema::create('detalle_ventas', function (Blueprint $table) {
            $table->increments('id_detalle');
            $table->unsignedInteger('id_venta')->nullable();
            $table->unsignedInteger('id_producto')->nullable();
            $table->integer('cantidad')->nullable();
            $table->decimal('precio_unitario', 10, 2)->nullable();
            $table->decimal('subtotal', 10, 2)->nullable();
            $table->string('personalizado', 255)->nullable();

            // Relaciones
            $table->foreign('id_venta')->references('id_venta')->on('ventas');
            $table->foreign('id_producto')->references('id_producto')->on('productos');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_ventas');
    }
};
