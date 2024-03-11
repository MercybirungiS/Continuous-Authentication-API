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
        Schema::create('virtual_keyboard_dynamics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('phone_id');
            $table->integer('flight_time');
            $table->integer('key_hold_time');
            $table->decimal('finger_pressure', 16, 4);
            $table->decimal('finger_area', 16, 4);
            $table->timestamps();
            $table->foreign('phone_id')->references('id')->on('phones')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('virtual_keyboard_dynamics');
    }
};
