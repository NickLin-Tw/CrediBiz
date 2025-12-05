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
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();

            // 相關員工（受影響的員工）
            $table->string('employee_id', 20)->nullable()->comment('相關員工編號');

            // 操作者資訊
            $table->string('actor_id', 20)->nullable()->comment('操作者 ID');
            $table->string('actor_type', 20)->default('employee')->comment('操作者類型：employee, admin, system');
            $table->string('actor_name', 100)->nullable()->comment('操作者姓名');

            // 行為資訊
            $table->string('action', 50)->comment('行為類型：issue_vc, verify_vp, revoke_vc, login, apply_job, apply_leave 等');
            $table->string('action_display', 100)->comment('行為顯示名稱');
            $table->text('description')->nullable()->comment('詳細描述');

            // 目標資訊
            $table->string('target_type', 50)->nullable()->comment('目標類型：vc, vp, application, leave 等');
            $table->string('target_id', 100)->nullable()->comment('目標 ID');

            // 結果
            $table->string('status', 20)->default('success')->comment('狀態：success, failed, pending');
            $table->text('reason')->nullable()->comment('原因或錯誤訊息');

            // 額外資訊
            $table->json('metadata')->nullable()->comment('額外資訊（JSON）');
            $table->string('ip_address', 45)->nullable()->comment('IP 地址');
            $table->text('user_agent')->nullable()->comment('User Agent');

            $table->timestamps();

            // 索引
            $table->index('employee_id');
            $table->index('actor_id');
            $table->index('action');
            $table->index('status');
            $table->index('created_at');
            $table->index(['employee_id', 'action']);
            $table->index(['actor_id', 'action']);

            // 外鍵
            $table->foreign('employee_id')->references('employee_id')->on('employees')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
