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
        Schema::table('visitor_parking_applications', function (Blueprint $table) {
            $table->string('name')->nullable()->after('email')->comment('訪客姓名');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('visitor_parking_applications', function (Blueprint $table) {
            $table->dropColumn('name');
        });
    }
};
