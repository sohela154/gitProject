<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id('service_id');
            $table->unsignedBigInteger('category_id');
            $table->string('service_name')->unique();
            $table->string('service_slug');
            $table->text('service_details');
            $table->string('service_img')->nullable();
            $table->string('seating_img')->nullable();
            $table->string('stage_img')->nullable();
            $table->string('price');
            $table->string('type');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
