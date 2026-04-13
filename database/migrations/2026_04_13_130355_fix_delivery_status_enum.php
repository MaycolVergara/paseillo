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
        DB::statement("UPDATE tables_delivery SET status = 'disponible' WHERE status = 'deliveryNoExistentes'");
        
        // Paso 2: Cambiar el enum para usar 'deliveryNoExistente' en lugar de 'deliveryNoExistentes'
        DB::statement("ALTER TABLE tables_delivery MODIFY COLUMN status ENUM('disponible', 'ocupado', 'deliveryNoExistente') DEFAULT 'disponible'");
        
        // Paso 3: Ahora actualizar los registros que deberían estar como no existentes
        // (esto se hará cuando el usuario ajuste las mesas nuevamente)
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revertir al enum original
        DB::statement("ALTER TABLE tables_delivery MODIFY COLUMN status ENUM('disponible', 'ocupado', 'deliveryNoExistentes') DEFAULT 'disponible'");
        
        // Revertir registros
        DB::statement("UPDATE tables_delivery SET status = 'deliveryNoExistentes' WHERE status = 'deliveryNoExistente'");
    }
};
