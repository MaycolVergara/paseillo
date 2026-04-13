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
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('name');             // Ej: "Leche Gloria", "Pan Burger"
            $table->integer('current_stock');   // Lo que hay hoy
            $table->integer('minimum_stock');   // El límite para avisarte
            $table->string('unit');             // Ej: "unidades", "paquetes"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // CORRECCIÓN: Aquí le faltaba la "s" a stores
        Schema::dropIfExists('stores');
    }
};
