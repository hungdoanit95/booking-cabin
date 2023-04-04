<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->string('clue')->nullable(); // Cột U Đầu mối
            $table->string('call')->nullable(); // Cột V Call
            $table->string('sale')->nullable(); // Cột W Sale
            $table->string('register')->nullable(); // Cột X Ghi danh tại văn phòng
            $table->text('schedule_price')->nullable(); // Cột Y Lịch Trình Đóng Tiền (Như trên hợp đồng)
            $table->string('misa_name')->nullable(); // Cột Z Tên Misa
            $table->string('misa_year')->nullable(); // Cột AA Năm
            $table->string('misa_month')->nullable(); // Cột AB tháng
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
        Schema::dropIfExists('employee');
    }
}
