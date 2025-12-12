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
        Schema::create('parking_permits', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id')->index()->comment('員工編號');
            $table->string('permit_id')->unique()->comment('停車證編號');
            $table->string('vp_transaction_id')->unique()->comment('VP 驗證交易 ID');
            $table->string('vc_transaction_id')->nullable()->comment('VC 發行交易 ID');
            $table->string('vc_cid')->nullable()->comment('VC CID');
            $table->string('name')->comment('姓名（從員工資料帶入）');
            $table->string('parking_type')->default('員工停車')->comment('停車類型');
            $table->timestamp('issued_at')->nullable()->comment('停車證發行時間');
            $table->date('expiry_date')->nullable()->comment('停車證到期日');
            $table->timestamps();

            $table->foreign('employee_id')->references('employee_id')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parking_permits');
    }
};
