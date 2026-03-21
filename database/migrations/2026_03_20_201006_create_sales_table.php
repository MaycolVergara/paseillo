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
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id'); // id_venta
            $table->unsignedInteger('user_id')->nullable(); // id_usuario
            $table->dateTime('date')->useCurrent(); // fecha
            $table->decimal('total', 10, 2)->default(0.00);
            $table->unsignedInteger('table_id')->nullable(); // id_mesa
            $table->integer('table_number'); // numero_mesa
            $table->string('status', 20)->default('open'); // estado (abierta -> open)
            $table->string('payment_method', 50)->nullable(); // metodo_pago

            // Relaciones
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('table_id')->references('id')->on('tables');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
