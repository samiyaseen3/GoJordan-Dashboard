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
            $table->unsignedBigInteger('user_id'); // Foreign Key to users table
            $table->unsignedBigInteger('tour_id'); // Foreign Key to tours table
            $table->dateTime('booking_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->enum('booking_status', ['Pending', 'Confirmed', 'Cancelled', 'Completed'])->default('Pending');
            $table->decimal('booking_price', 10, 2); // Booking price
            $table->enum('payment_status', ['Pending', 'Paid', 'Failed'])->default('Pending');
            $table->enum('payment_method', ['Credit Card', 'PayPal', 'Bank Transfer'])->default('Credit Card');
            $table->dateTime('payment_date')->nullable();
            $table->integer('number_of_guests');
            $table->date('check_in_date')->nullable();
            $table->date('check_out_date')->nullable();
            $table->boolean('is_deleted')->default(false);
            $table->timestamps(); // created_at & updated_at

            // Foreign Keys
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('tour_id')->references('tour_id')->on('tours')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
