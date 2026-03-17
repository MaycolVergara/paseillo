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
        Schema::create('mesas', function (Blueprint $table) {
            $table->increments('id_mesa');
            $table->integer('numero_mesa');
            $table->enum('estado', ['disponible', 'ocupada'])->default('disponible');
            $table->unsignedInteger('id_usuario_atendiendo')->nullable();

            // Relación con la tabla usuarios
            $table->foreign('id_usuario_atendiendo')->references('id_usuario')->on('usuarios')
                ->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mesas');
    }
};
