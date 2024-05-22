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
        Schema::create('events', function (Blueprint $table) {
            $table->integer('EventId')->primary();
            $table->string('EventName',50);
            $table->string('Description',50);
            $table->date('StartDate');
            $table->date('EndDate');
            $table->integer('Organizer_eventId');
            $table->integer('Organizer_venueId');
            $table->foreign('Organizer_eventId')->references('OrganizerId')->on('organizer');
            $table->foreign('Organizer_venueId')->references('VenueId')->on('venues');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
};
