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
            $table->boolean('is_active')->default(true)->after('last_login_at')->comment('是否在職');
            $table->date('resignation_date')->nullable()->after('is_active')->comment('離職日期');
            $table->text('resignation_reason')->nullable()->after('resignation_date')->comment('離職原因');

            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn(['is_active', 'resignation_date', 'resignation_reason']);
        });
    }
};
