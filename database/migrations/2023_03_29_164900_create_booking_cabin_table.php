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
            $table->string('date_booking')->nullable();
            $table->string('name_booking')->nullable();
            $table->string('email_booking')->nullable();
            $table->string('telephone_booking')->nullable();
            $table->smallInteger('is_admin')->nullable();
            $table->integer('admin_id')->nullable();
            $table->string('notes_booking')->nullable();
            $table->integer('status')->default(1);// 1: Chờ duyệt, 2: Đã kích hoạt, 3: Hủy 
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
