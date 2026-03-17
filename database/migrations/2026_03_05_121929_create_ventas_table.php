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
        Schema::create('ventas', function (Blueprint $table) {
            $table->increments('id_venta');
            $table->unsignedInteger('id_usuario')->nullable();
            $table->dateTime('fecha')->useCurrent();
            $table->decimal('total', 10, 2)->default(0.00);
            $table->unsignedInteger('id_mesa')->nullable();
            $table->integer('numero_mesa');
            $table->string('estado', 20)->default('abierta');
            $table->string('metodo_pago', 50)->nullable();
            // Relaciones
            $table->foreign('id_usuario')->references('id_usuario')->on('usuarios')->onDelete('cascade');
            $table->foreign('id_mesa')->references('id_mesa')->on('mesas');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
