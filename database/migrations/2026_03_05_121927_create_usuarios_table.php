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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('id_usuario');
            $table->string('nombre', 50);
            $table->string('correo', 100);
            $table->string('user', 100)->unique(); // El nombre de usuario único
            $table->string('password', 255);       // Largo para Bcrypt
            $table->unsignedInteger('rol');
            $table->foreign('rol')->references('id_rol')->on('roles');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
