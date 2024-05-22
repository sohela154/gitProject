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
     * Events
   *- Attributes: EventID, EventName, Description, StartDate, EndDate, OrganizerID, VenueID
   *- Primary Key: EventID
   *- Foreign Keys: OrganizerID references Organizers(OrganizerID), VenueID references Venues(VenueID
     */
    public function up()
    {
        Schema::create('event_events', function (Blueprint $table) {
            $table->id();
            $table->string('EventName',20);
            $table->text('Description')->nullable();
            $table->date('StartDate');
            $table->date('EndDate');
            $table->unsignedBigInteger('organizerId');
            $table->foreign('organizerId')->references('id')->on('event_organizers');
            $table->unsignedBigInteger('venueId');
            $table->foreign('venueId')->references('id')->on('event_venues');
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
        Schema::dropIfExists('event_events');
    }
};
