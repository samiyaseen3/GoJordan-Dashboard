<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourItinerariesTable extends Migration
{
    public function up(): void
    {
        Schema::create('tour_itineraries', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('tour_id')->constrained('tours')->onDelete('cascade'); // Foreign key referencing tours
            $table->integer('day_number'); // Day in the itinerary
            $table->string('location'); // Location for the day
            $table->text('activity'); // Description of the day's activities
            $table->string('meal_plan')->nullable(); // Optional meal plan for the day
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tour_itineraries');
    }
}
