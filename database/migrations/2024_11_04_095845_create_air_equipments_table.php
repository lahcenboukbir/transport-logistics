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
        Schema::create('air_equipments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('shipment_id')->constrained('shipments')->onDelete('cascade');
            $table->double('volume');
            $table->double('weight');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('air_equipments');
    }
};
