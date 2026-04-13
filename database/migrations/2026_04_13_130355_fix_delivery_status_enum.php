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
        
        // Paso 2: Cambiar el enum basado en el motor de base de datos
        if (DB::getDriverName() === 'pgsql') {
            // Lógica para PostgreSQL (Laravel Cloud) para evitar error de sintaxis en el CHECK
            DB::statement('ALTER TABLE tables_delivery DROP CONSTRAINT IF EXISTS tables_delivery_status_check');
            DB::statement("ALTER TABLE tables_delivery ALTER COLUMN status TYPE VARCHAR(255)");
            DB::statement("ALTER TABLE tables_delivery ALTER COLUMN status SET DEFAULT 'disponible'");
            DB::statement("ALTER TABLE tables_delivery ADD CONSTRAINT tables_delivery_status_check CHECK (status IN ('disponible', 'ocupado', 'deliveryNoExistente'))");
        } else {
            // Lógica estándar para MySQL/MariaDB (Local Laragon)
            Schema::table('tables_delivery', function (Blueprint $table) {
                $table->enum('status', ['disponible', 'ocupado', 'deliveryNoExistente'])
                      ->default('disponible')
                      ->change();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (DB::getDriverName() === 'pgsql') {
            DB::statement('ALTER TABLE tables_delivery DROP CONSTRAINT IF EXISTS tables_delivery_status_check');
            DB::statement("ALTER TABLE tables_delivery ALTER COLUMN status TYPE VARCHAR(255)");
            DB::statement("ALTER TABLE tables_delivery ALTER COLUMN status SET DEFAULT 'disponible'");
            DB::statement("ALTER TABLE tables_delivery ADD CONSTRAINT tables_delivery_status_check CHECK (status IN ('disponible', 'ocupado', 'deliveryNoExistentes'))");
        } else {
            Schema::table('tables_delivery', function (Blueprint $table) {
                $table->enum('status', ['disponible', 'ocupado', 'deliveryNoExistentes'])
                      ->default('disponible')
                      ->change();
            });
        }
        
        // Revertir registros
        DB::table('tables_delivery')
            ->where('status', 'deliveryNoExistente')
            ->update(['status' => 'deliveryNoExistentes']);
    }
};
