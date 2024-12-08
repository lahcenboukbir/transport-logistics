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
        Schema::create('prospects', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('company');
            $table->string('ice')->nullable();
            $table->string('email')->unique();
            $table->string('phone_number')->nullable();
            $table->enum('status', ['new', 'interested', 'not interested', 'customer'])->default('new');
            $table->string('city')->nullable();
            $table->string('activity')->nullable();
            $table->string('notes')->nullable();
            $table->dateTime('next_followup_date')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prospects');
    }
};
