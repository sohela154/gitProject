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
        Schema::create('_u_s_e_r_s', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('FirstName',50);
            $table->string('LastName',50);
            $table->string('Email',50);
            $table->string('Password',50);
            $table->integer('PhoneNumber');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('_u_s_e_r_s');
    }
};
