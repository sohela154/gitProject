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
    * Catering
   * Attributes: CateringID, PackageID, MenuOptions, PricePerPerson, ServiceType
   * Primary Key: CateringID
   * Foreign Key: PackageID references Packages(PackageID)
     */
    public function up()
    {
        Schema::create('event_catering', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('packageId');
            $table->foreign('packageId')->references('id')->on('event_packages');
            $table->text('MenuOptions');
            $table->decimal('PricePerPerson', 10, 2);
            $table->string('ServiceType',25);
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
        Schema::dropIfExists('event_catering');
    }
};
