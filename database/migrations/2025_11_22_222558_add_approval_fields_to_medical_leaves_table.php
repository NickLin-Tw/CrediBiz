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
        Schema::table('medical_leaves', function (Blueprint $table) {
            $table->enum('status', ['pending', 'approved', 'rejected'])
                ->default('pending')
                ->after('doctor_recommendation')
                ->comment('審核狀態');

            $table->string('reviewed_by')->nullable()->after('status')->comment('審核者');
            $table->timestamp('reviewed_at')->nullable()->after('reviewed_by')->comment('審核時間');
            $table->text('review_note')->nullable()->after('reviewed_at')->comment('審核備註');

            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('medical_leaves', function (Blueprint $table) {
            $table->dropColumn(['status', 'reviewed_by', 'reviewed_at', 'review_note']);
        });
    }
};
