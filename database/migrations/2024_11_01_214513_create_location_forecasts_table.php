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
            $table->dateTime('date');
            $table->string('icon');
            $table->string('main_description');
            $table->string('description');
            $table->float('temperature');
            $table->float('temperature_min');
            $table->float('temperature_max');
            $table->integer('humidity');
            $table->float('rain');
            $table->float('wind_speed');
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
