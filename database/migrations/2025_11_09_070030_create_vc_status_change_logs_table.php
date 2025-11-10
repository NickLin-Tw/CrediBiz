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
        Schema::create('vc_status_change_logs', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id', 6)->comment('執行操作的員工編號');
            $table->string('action')->comment('操作類型：revoke, suspend, restore');
            $table->string('reason')->comment('操作原因');
            $table->string('old_vc_cid')->nullable()->comment('原本的 VC CID');
            $table->string('new_vc_cid')->nullable()->comment('新的 VC CID（換發時）');
            $table->string('vc_uid')->comment('VC 模板 UID');
            $table->string('transaction_id')->nullable()->comment('TW-DIW 交易 ID');
            $table->json('response_data')->nullable()->comment('API 回應資料');
            $table->timestamps();

            // 索引
            $table->index('employee_id');
            $table->index('action');
            $table->index('old_vc_cid');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vc_status_change_logs');
    }
};
