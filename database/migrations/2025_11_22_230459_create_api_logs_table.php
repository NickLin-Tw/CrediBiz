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
        Schema::create('api_logs', function (Blueprint $table) {
            $table->id();

            // API 基本資訊
            $table->string('service')->comment('服務名稱：issuer, verifier');
            $table->string('method')->comment('HTTP 方法：GET, POST, PUT, DELETE');
            $table->string('endpoint')->comment('API Endpoint');
            $table->text('full_url')->comment('完整 URL');

            // Request 資訊
            $table->json('request_headers')->nullable()->comment('Request Headers');
            $table->json('request_body')->nullable()->comment('Request Body');

            // Response 資訊
            $table->integer('response_status')->nullable()->comment('HTTP Status Code');
            $table->json('response_headers')->nullable()->comment('Response Headers');
            $table->json('response_body')->nullable()->comment('Response Body');

            // 執行時間與狀態
            $table->integer('duration_ms')->nullable()->comment('執行時間（毫秒）');
            $table->boolean('success')->default(false)->comment('是否成功');
            $table->text('error_message')->nullable()->comment('錯誤訊息');

            // 關聯資訊
            $table->string('transaction_id')->nullable()->comment('交易 ID');
            $table->string('employee_id')->nullable()->comment('關聯員工 ID');
            $table->string('triggered_by')->nullable()->comment('觸發者');

            $table->timestamps();

            // 索引
            $table->index('service');
            $table->index('endpoint');
            $table->index('success');
            $table->index('transaction_id');
            $table->index('employee_id');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api_logs');
    }
};
