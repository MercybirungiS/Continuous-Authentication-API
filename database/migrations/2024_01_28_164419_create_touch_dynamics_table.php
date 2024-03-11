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
        Schema::create('touch_dynamics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('phone_id');
            $table->decimal('finger_pressure', 16, 4);
            $table->decimal('finger_blocked_area', 16, 4);
            $table->integer('hold_time');
            $table->string('finger_orientation');
            $table->timestamps();
            $table->foreign('phone_id')->references('id')->on('phones')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('touch_dynamics');
    }
};
