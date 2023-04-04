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
            $table->string('clue'); // Cột U Đầu mối
            $table->string('call'); // Cột V Call
            $table->string('sale'); // Cột W Sale
            $table->string('register'); // Cột X Ghi danh tại văn phòng
            $table->string('schedule_price'); // Cột Y Lịch Trình Đóng Tiền (Như trên hợp đồng)
            $table->string('misa_name'); // Cột Z Tên Misa
            $table->string('misa_year'); // Cột AA Năm
            $table->string('misa_month'); // Cột AB tháng
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
