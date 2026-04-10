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
        Schema::create('staff', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->string('surname', 50);
            $table->string('phone', 15)->nullable();
            $table->string('dni', 15)->unique();
            $table->string('email', 100)->nullable();
            $table->string('address', 100)->nullable();
            $table->decimal('salary', 10, 2)->default(0.00);
            $table->string('position', 50)->nullable();
            $table->boolean('is_active')->default(true);
            $table->date('hire_date')->nullable();
            $table->integer('payment_day')->nullable();
            $table->decimal('advance_payment', 10, 2)->default(0.00)->nullable(); // Adelanto de sueldo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
