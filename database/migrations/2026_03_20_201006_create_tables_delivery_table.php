<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('table_delivery', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('table_number');
            $table->enum('status', ['disponible', 'ocupado'])->default('disponible'); // estado


            $table->unsignedInteger('user_id')->nullable();
            // Relación con la tabla users (id_usuario)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_delivery');
    }
};
