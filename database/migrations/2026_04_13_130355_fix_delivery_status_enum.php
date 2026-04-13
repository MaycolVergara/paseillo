<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Paso 1: Primero actualizar los datos existentes a un valor válido temporal
        DB::table('tables_delivery')
            ->where('status', 'deliveryNoExistentes')
            ->update(['status' => 'disponible']);
        
        // Paso 2: Cambiar el enum para usar 'deliveryNoExistente' en lugar de 'deliveryNoExistentes'
        Schema::table('tables_delivery', function (Blueprint $table) {
            $table->enum('status', ['disponible', 'ocupado', 'deliveryNoExistente'])
                  ->default('disponible')
                  ->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revertir al enum original
        Schema::table('tables_delivery', function (Blueprint $table) {
            $table->enum('status', ['disponible', 'ocupado', 'deliveryNoExistentes'])
                  ->default('disponible')
                  ->change();
        });
        
        // Revertir registros
        DB::table('tables_delivery')
            ->where('status', 'deliveryNoExistente')
            ->update(['status' => 'deliveryNoExistentes']);
    }
};
