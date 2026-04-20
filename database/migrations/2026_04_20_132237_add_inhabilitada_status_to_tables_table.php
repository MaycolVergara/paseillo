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
        $driver = DB::connection()->getDriverName();
        
        if ($driver === 'mysql' || $driver === 'mariadb') {
            DB::statement("ALTER TABLE `tables` MODIFY COLUMN `status` ENUM('disponible', 'ocupado', 'mesasInhabilitada', 'mesasNoExistentes') DEFAULT 'disponible'");
        } elseif ($driver === 'pgsql') {
            DB::statement("ALTER TABLE tables DROP CONSTRAINT IF EXISTS tables_status_check");
            DB::statement("ALTER TABLE tables ADD CONSTRAINT tables_status_check CHECK (status::text = ANY (ARRAY['disponible'::character varying, 'ocupado'::character varying, 'mesasInhabilitada'::character varying, 'mesasNoExistentes'::character varying]::text[]))");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $driver = DB::connection()->getDriverName();
        
        if ($driver === 'mysql' || $driver === 'mariadb') {
            DB::statement("ALTER TABLE `tables` MODIFY COLUMN `status` ENUM('disponible', 'ocupado', 'mesasNoExistentes') DEFAULT 'disponible'");
        } elseif ($driver === 'pgsql') {
            DB::statement("ALTER TABLE tables DROP CONSTRAINT IF EXISTS tables_status_check");
            DB::statement("ALTER TABLE tables ADD CONSTRAINT tables_status_check CHECK (status::text = ANY (ARRAY['disponible'::character varying, 'ocupado'::character varying, 'mesasNoExistentes'::character varying]::text[]))");
        }
    }
};
