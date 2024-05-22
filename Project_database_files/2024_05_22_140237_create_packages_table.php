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
        Schema::create('packages', function (Blueprint $table) {
            $table->integer('PackageId')->primary();
            $table->string('PackageName',50);
            $table->string('PackageType',50);
            $table->integer('Price');
            $table->string('Description',50);
            $table->integer('Organizer_packageId');
            $table->foreign('Organizer_packageId')->references('OrganizerId')->on('organizer');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('packages');
    }
};
