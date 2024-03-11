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
        Schema::create('battery_metrics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('phone_id');
            $table->decimal('voltage', 16, 4); 
            $table->decimal('current', 16, 4); 
            $table->timestamps();
            $table->foreign('phone_id')->references('id')->on('phones')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('battery_metrics');
    }
};
