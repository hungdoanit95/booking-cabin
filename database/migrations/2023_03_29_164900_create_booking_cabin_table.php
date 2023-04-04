<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingCabinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_cabin', function (Blueprint $table) {
            $table->id();
            $table->string('cabin_id')->nullable();
            $table->string('time_id')->nullable();
            $table->date('date_booking')->nullable();
            $table->string('name_booking')->nullable();
            $table->string('email_booking')->nullable();
            $table->string('telephone_booking')->nullable();
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
        Schema::dropIfExists('booking_cabin');
    }
}
