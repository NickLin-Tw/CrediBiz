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
        Schema::table('vp_verification_results', function (Blueprint $table) {
            $table->string('employee_id', 20)->nullable()->after('transaction_id')->comment('員工編號');
            $table->string('vp_type', 100)->nullable()->after('employee_id')->comment('VP 類型（如：medical_leave, employee_verification）');
            $table->text('rejection_reason')->nullable()->after('result_description')->comment('拒絕原因（額外驗證失敗時）');

            $table->index('employee_id');
            $table->index('vp_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vp_verification_results', function (Blueprint $table) {
            $table->dropIndex(['employee_id']);
            $table->dropIndex(['vp_type']);
            $table->dropColumn(['employee_id', 'vp_type', 'rejection_reason']);
        });
    }
};
