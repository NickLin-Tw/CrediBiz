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
            // 刪除應徵頁面不使用的欄位
            $table->dropColumn([
                'student_id',        // 應徵時不需要學生證號
                'toeic_institution', // 應徵頁面沒有此欄位
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            // 恢復欄位
            $table->string('student_id')->nullable();
            $table->string('toeic_institution')->nullable();
        });
    }
};
