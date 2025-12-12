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
        Schema::create('medical_leaves', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id', 20)->comment('員工編號');
            $table->uuid('vp_transaction_id')->comment('VP 驗證交易 ID');

            // VP 中的建議休養日期（read-only）
            $table->date('rest_start_date')->comment('建議休養起始日（來自 VP）');
            $table->date('rest_end_date')->comment('建議休養結束日（來自 VP）');

            // 員工實際申請的請假日期（可修改）
            $table->date('leave_start_date')->comment('請假起始日');
            $table->date('leave_end_date')->comment('請假結束日');

            // 計算天數
            $table->integer('leave_days')->comment('請假天數');

            // VP 中的醫療資訊（儲存用於後台查看）
            $table->string('hospital_name')->nullable()->comment('醫療院所名稱');
            $table->string('doctor_name')->nullable()->comment('醫師姓名');
            $table->text('doctor_recommendation')->nullable()->comment('醫師建議');

            $table->timestamps();

            // 索引
            $table->index('employee_id');
            $table->index('vp_transaction_id');
            $table->index('leave_start_date');
            $table->index('created_at');

            // 外鍵約束
            $table->foreign('employee_id')->references('employee_id')->on('employees')->onDelete('cascade');
            $table->foreign('vp_transaction_id')->references('transaction_id')->on('vp_verification_results')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_leaves');
    }
};
