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
     * Decoration
    * Attributes: DecorationID, PackageID, Theme, DecorationItems, Price
    * Primary Key: DecorationID
    * Foreign Key: PackageID references Packages(PackageID)
     */
    public function up()
    {
        Schema::create('event_decoration', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('packageId');
            $table->foreign('packageId')->references('id')->on('event_packages');
            $table->string('Theme',40);
            $table->text('DecorationItems');
            $table->decimal('Price', 10, 2);
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
        Schema::dropIfExists('event_decoration');
    }
};
