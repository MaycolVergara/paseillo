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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->default('Paseillo');
            $table->string('company_subtitle')->default('Burger & Pizzas');
            $table->string('company_logo')->nullable(); // Almacenará la ruta o nombre del archivo
            $table->timestamps();
        });

        // Insertar registro inicial
        DB::table('settings')->insert([
            'company_name' => 'Paseillo',
            'company_subtitle' => 'Burger & Pizzas',
            'company_logo' => 'img/logo_principal.png',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
