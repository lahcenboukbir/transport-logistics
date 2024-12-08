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
        Schema::create('road_equipments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('shipment_id')->constrained('shipments')->onDelete('cascade');
            $table->foreignId('equipment_name_id')->constrained('equipment_names')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('road_equipments');
    }
};
