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
        Schema::create('location_forecasts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('location_id')->constrained();
            $table->date('date');
            $table->integer('temperature');
            $table->integer('humidity');
            $table->integer('rainfall');
            $table->integer('wind_speed');
            $table->integer('wind_direction');
            $table->integer('pressure');
            $table->integer('visibility');
            $table->integer('cloud_cover');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('location_forecasts');
    }
};
