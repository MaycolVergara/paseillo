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
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id'); // id_producto
            $table->string('name', 100)->nullable(); // nombre_producto
            $table->decimal('price', 10, 2); // precio
            $table->text('description')->nullable(); // descripcion_producto
            $table->dateTime('delivery_date')->nullable(); // fecha_entrega
            $table->string('image', 250)->nullable(); // imagen_producto
            $table->unsignedInteger('category_id')->nullable(); // id_categoria
            $table->unsignedBigInteger('stores_id')->nullable();

            $table->foreign('category_id')->references('id')->on('categories'); // id_categoria
            $table->foreign('stores_id')->references('id')->on('stores')->onDelete('set null');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
