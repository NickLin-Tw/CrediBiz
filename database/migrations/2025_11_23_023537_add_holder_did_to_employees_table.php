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
            $table->string('holder_did')->nullable()->after('employee_vc_expiry_date')->comment('Holder DID (從員工證 JWT sub 欄位取得，用於驗證後續申請 VC 是否為同一裝置)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn('holder_did');
        });
    }
};
