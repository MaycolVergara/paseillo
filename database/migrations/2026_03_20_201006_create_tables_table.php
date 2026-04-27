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
        Schema::create('tables', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('table_number');
            $table->enum('status',
                ['disponible', 'ocupado', 'mesasInhabilitada', 'mesasNoExistentes'])->default('disponible');

            // CONEXIÓN HACIA LOS USUARIOS (Mozos/Admins)
           // $table->unsignedInteger('serving_user_id')->nullable();
            //$table->foreign('serving_user_id')->references('id')->on('users')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tables');
    }
};
