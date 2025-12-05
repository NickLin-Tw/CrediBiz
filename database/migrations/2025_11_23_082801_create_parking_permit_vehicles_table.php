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
        Schema::create('parking_permit_vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parking_permit_id')->constrained('parking_permits')->onDelete('cascade');
            $table->string('vehicle_plate_number')->comment('車牌號碼');
            $table->string('vehicle_type')->comment('車種（小客車、機車等）');
            $table->string('brand_model')->comment('廠牌與車型');
            $table->string('color')->comment('車色');
            $table->timestamps();

            $table->index(['parking_permit_id', 'vehicle_plate_number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parking_permit_vehicles');
    }
};
