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
        Schema::create('vp_verification_logs', function (Blueprint $table) {
            $table->id();
            $table->string('machine_id')->index()->comment('機器 ID');
            $table->string('transaction_id')->index()->comment('交易 ID');
            $table->string('vp_ref')->comment('VP 驗證服務代碼');
            $table->string('vp_name')->comment('VP 驗證服務名稱');
            $table->string('action')->comment('動作：config_requested, scan_detected, verify_success, verify_failed');
            $table->boolean('verify_result')->nullable()->comment('驗證結果：true=成功, false=失敗, null=尚未驗證');
            $table->string('result_description')->nullable()->comment('結果描述');
            $table->json('credential_data')->nullable()->comment('憑證資料（JSON）');
            $table->string('permit_id')->nullable()->comment('停車證編號');
            $table->string('name')->nullable()->comment('姓名');
            $table->string('parking_type')->nullable()->comment('停車類型');
            $table->timestamp('verified_at')->nullable()->comment('驗證時間');
            $table->timestamps();

            $table->foreign('machine_id')->references('machine_id')->on('vp_machines')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vp_verification_logs');
    }
};
