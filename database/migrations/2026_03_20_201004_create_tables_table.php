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
        Schema::create('tables', function (Blueprint $table) {
            $table->increments('id'); // id_mesa
            $table->integer('table_number'); // numero_mesa
            $table->enum('status', ['disponible', 'ocupado','mesasNoExistentes'])->default('disponible');
            $table->unsignedInteger('serving_user_id')->nullable(); // id_usuario_atendiendo

            // Relación con la tabla users (id_usuario)
            $table->foreign('serving_user_id')->references('id')->on('users')
                ->onDelete('set null');

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
