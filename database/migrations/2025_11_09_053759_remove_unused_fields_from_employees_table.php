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
        Schema::table('employees', function (Blueprint $table) {
            // 只刪除不需要的驗證欄位
            $table->dropColumn([
                'is_verified',
                'last_verified_at',
            ]);

            // 新增員工證領取 token
            $table->string('credential_token')->unique()->nullable()->after('employee_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            // 恢復驗證欄位
            $table->boolean('is_verified')->default(false);
            $table->timestamp('last_verified_at')->nullable();

            // 刪除 token 欄位
            $table->dropColumn('credential_token');
        });
    }
};
