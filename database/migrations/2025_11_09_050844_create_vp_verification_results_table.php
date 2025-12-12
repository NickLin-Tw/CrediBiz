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
        Schema::create('vp_verification_results', function (Blueprint $table) {
            $table->id();
            $table->uuid('transaction_id')->unique()->comment('VP 驗證交易 ID');
            $table->boolean('verify_result')->comment('驗證結果');
            $table->string('result_description')->nullable()->comment('驗證結果描述');
            $table->json('credentials')->comment('憑證資料（data 陣列）');
            $table->json('full_response')->nullable()->comment('完整的 API 回應');
            $table->boolean('is_used')->default(false)->comment('是否已被使用');
            $table->timestamp('verified_at')->comment('驗證時間');
            $table->timestamps();

            $table->index('transaction_id');
            $table->index('is_used');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vp_verification_results');
    }
};
