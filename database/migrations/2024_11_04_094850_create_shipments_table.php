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
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('consultation_id')->constrained('consultations')->onDelete('cascade');
            $table->foreignId('departure_port_id')->constrained('ports')->onDelete('cascade');
            $table->foreignId('arrival_port_id')->constrained('ports')->onDelete('cascade');
            $table->dateTime('departure_date')->nullable();
            $table->dateTime('arrival_date')->nullable();
            $table->string('notes')->nullable();
            $table->enum('medium_name', ['air', 'maritime', 'road']);
            $table->integer('quantity')->nullable()->unsigned();
            $table->string('tracking_number')->nullable()->unique();
            $table->enum('status', ['in_transit', 'delivered', 'pending', 'canceled'])->default('pending');
            $table->string('delayed_reason')->nullable();
            $table->double('buying_price')->nullable();
            $table->double('selling_price')->nullable();
            $table->double('agent_commission')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};
