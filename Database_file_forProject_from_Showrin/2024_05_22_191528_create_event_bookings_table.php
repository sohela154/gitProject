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
    /**
     * Bookings
    * Attributes: BookingID, EventID, CustomerID, BookingDate, TotalCost
    * Primary Key: BookingID
    * Foreign Keys: EventID references Events(EventID), CustomerID references Customers(CustomerID)

     */
    public function up()
    {
        Schema::create('event_bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('eventId');
            $table->foreign('eventId')->references('id')->on('event_events');
            $table->unsignedBigInteger('customerId');
            $table->foreign('customerId')->references('id')->on('event_customers');
            $table->date('BookingDate');
            $table->decimal('TotalCost', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_bookings');
    }
};
