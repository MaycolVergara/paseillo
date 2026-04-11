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
        Schema::create('staff_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('staff_id');
            // 'payment_type': 'salary' (pago de sueldo final), 'advance' (adelanto)
            $table->string('payment_type')->default('salary');
            $table->decimal('base_salary', 10, 2);
            $table->decimal('advance_deducted', 10, 2)->default(0);
            $table->decimal('net_paid', 10, 2);
            $table->text('notes')->nullable();
            
            $table->timestamps();

            $table->foreign('staff_id')->references('id')->on('staff')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff_payments');
    }
};
