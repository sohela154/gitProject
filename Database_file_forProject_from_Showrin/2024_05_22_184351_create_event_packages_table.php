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
        Schema::create('event_packages', function (Blueprint $table) {
            $table->id();
            $table->string('packageName',30);
            $table->string('PackageType',20);
            $table->decimal('Price', 10, 2);
            $table->text('Description')->nullable();
            $table->unsignedBigInteger('organizerId');
            $table->foreign('organizerId')->references('id')->on('event_organizers');
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
        Schema::dropIfExists('event_packages');
    }
};
