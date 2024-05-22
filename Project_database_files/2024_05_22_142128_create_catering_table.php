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
        Schema::create('catering', function (Blueprint $table) {
            $table->integer('CateringId')->primary();
            $table->string('MenuOptions',50);
            $table->integer('PricePerson');
            $table->string('MenuType',50);
            $table->integer('Catering_packageId');
            $table->foreign('Catering_packageId')->references('PackageId')->on('packages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catering');
    }
};
