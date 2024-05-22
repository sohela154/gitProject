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
        Schema::create('decoration', function (Blueprint $table) {
            $table->integer('DecorationId')->primary();
            $table->string('Theme',50);
            $table->string('DecorationItems',50);
            $table->integer('Price');
            $table->integer('Decoration_packageId');
            $table->foreign('Decoration_packageId')->references('PackageId')->on('packages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('decoration');
    }
};
