<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('id_producto'); // Esta es la UNICA llave primaria y autoincremental
            $table->string('nombre_producto', 100)->nullable(); //
            $table->decimal('precio', 10, 2);
            $table->string('descripcion_producto', 100)->nullable(); //
            $table->dateTime('fecha_entrega')->nullable(); //
            $table->string('imagen_producto', 100)->nullable();
            $table->unsignedInteger('id_categoria')->nullable(); //
            $table->foreign('id_categoria')->references('id_categoria')->on('categorias'); //
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
