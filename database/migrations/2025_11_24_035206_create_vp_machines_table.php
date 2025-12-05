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
        Schema::create('vp_machines', function (Blueprint $table) {
            $table->id();
            $table->string('machine_id')->unique()->comment('機器唯一 ID，如：VP-MACHINE-001');
            $table->string('name')->comment('機器名稱，如：停車場入口驗證機');
            $table->string('vp_ref')->default('00000000_vp_parking')->comment('VP 驗證服務代碼');
            $table->string('vp_name')->default('停車證呈現憑證')->comment('VP 驗證服務名稱');
            $table->string('location')->nullable()->comment('機器位置');
            $table->string('status')->default('active')->comment('狀態：active, inactive, maintenance');
            $table->timestamp('last_seen_at')->nullable()->comment('最後連線時間');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vp_machines');
    }
};
