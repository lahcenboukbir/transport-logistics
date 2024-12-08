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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('prospect_id')->constrained('prospects')->onDelete('cascade');
            $table->dateTime('appointment_date');
            $table->enum('outcome', ['success', 'fail', 'pending'])->default('pending');
            $table->string('duration')->nullable();
            $table->string('notes')->nullable();
            $table->string('location')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
