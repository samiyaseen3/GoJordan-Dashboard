<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id('id'); // Primary Key
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Foreign key referencing users
            $table->foreignId('tour_id')->constrained('tours')->onDelete('cascade'); // Foreign key referencing tours
            $table->foreignId('tour_date_id')->constrained('tour_dates')->onDelete('cascade'); // Foreign key referencing tour_dates
            $table->dateTime('booking_date')->default(DB::raw('CURRENT_TIMESTAMP')); // Booking date
            $table->enum('booking_status', ['Pending', 'Confirmed', 'Cancelled', 'Completed'])->default('Pending'); // Booking status
            $table->decimal('booking_price', 10, 2); // Booking price
            $table->enum('payment_status', ['Pending', 'Paid', 'Failed'])->default('Pending'); // Payment status
            $table->enum('payment_method', ['Credit Card', 'PayPal', 'Bank Transfer'])->default('Credit Card'); // Payment method
            $table->dateTime('payment_date')->nullable(); // Payment date
            $table->integer('number_of_guests'); // Number of guests
            $table->date('check_in_date')->nullable(); // Check-in date
            $table->date('check_out_date')->nullable(); // Check-out date
            $table->boolean('is_deleted')->default(false); // Soft delete flag
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings'); // Drop the bookings table
    }
}
