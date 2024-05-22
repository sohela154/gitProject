<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->integer('BookingId')->primary();
            $table->date('BookingDate');
            $table->integer('TotalCost');
            $table->integer('Booking_eventId');
            $table->integer('Booking_customerId');
            $table->foreign('Booking_eventId')->references('EventId')->on('events');
            $table->foreign('Booking_customerId')->references('CustomerId')->on('customers');
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
};
