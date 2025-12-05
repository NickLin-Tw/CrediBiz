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
        Schema::create('visitor_parking_applications', function (Blueprint $table) {
            $table->id();

            // 訪客資訊
            $table->string('email')->comment('訪客電子郵件');
            $table->text('application_reason')->comment('申請原因');

            // 車輛資訊
            $table->string('vehicle_plate_number')->comment('車牌號碼');
            $table->string('vehicle_type')->comment('車種');
            $table->string('brand_model')->comment('廠牌與車型');
            $table->string('color')->comment('車色');

            // 停車日期範圍
            $table->date('parking_start_date')->comment('停車起始日');
            $table->date('parking_end_date')->comment('停車結束日');

            // 審核狀態
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->comment('審核狀態');
            $table->string('reviewed_by')->nullable()->comment('審核者員工編號');
            $table->timestamp('reviewed_at')->nullable()->comment('審核時間');
            $table->text('review_note')->nullable()->comment('審核備註');

            // 停車證資訊（審核通過後產生）
            $table->string('permit_id')->nullable()->unique()->comment('停車證編號');
            $table->string('visitor_token')->unique()->comment('訪客領取 token');
            $table->string('vc_transaction_id')->nullable()->comment('VC 發行交易 ID');
            $table->string('vc_cid')->nullable()->comment('VC CID');
            $table->text('qr_code')->nullable()->comment('QR Code（base64）');
            $table->text('deep_link')->nullable()->comment('Deep Link');

            // 領取狀態
            $table->boolean('is_issued')->default(false)->comment('是否已領取');
            $table->timestamp('issued_at')->nullable()->comment('領取時間');

            $table->timestamps();

            $table->index(['email', 'status']);
            $table->index('visitor_token');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitor_parking_applications');
    }
};
