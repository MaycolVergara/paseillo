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
        // MySQL enum modification - add 'mesasInhabilitada' status
        DB::statement("ALTER TABLE `tables` MODIFY COLUMN `status` ENUM('disponible', 'ocupado', 'mesasInhabilitada', 'mesasNoExistentes') DEFAULT 'disponible'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE `tables` MODIFY COLUMN `status` ENUM('disponible', 'ocupado', 'mesasNoExistentes') DEFAULT 'disponible'");
    }
};
