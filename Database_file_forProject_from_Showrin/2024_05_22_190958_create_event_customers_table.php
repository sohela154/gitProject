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
     * Customers
     * Attributes: CustomerID, FirstName, LastName, Email, PhoneNumber, Address
     * Primary Key: CustomerID
     */
    public function up()
    {
        Schema::create('event_customers', function (Blueprint $table) {
            $table->id();
            $table->string('FirstName',20);
            $table->string('LastName',20);
            $table->string('Email',30)->unique();
            $table->string('PhoneNumber',15);
            $table->string('Address',40);
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
        Schema::dropIfExists('event_customers');
    }
};
