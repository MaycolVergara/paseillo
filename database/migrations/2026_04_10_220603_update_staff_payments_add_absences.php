<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('staff_payments', function (Blueprint $table) {
            $table->integer('absences_count')->default(0)->after('base_salary');
            $table->decimal('absences_deducted', 10, 2)->default(0)->after('absences_count');
        });
    }

    public function down(): void
    {
        Schema::table('staff_payments', function (Blueprint $table) {
            $table->dropColumn(['absences_count', 'absences_deducted']);
        });
    }
};
