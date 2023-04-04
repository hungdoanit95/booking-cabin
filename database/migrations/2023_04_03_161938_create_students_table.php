<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->date('time_hidden'); // Cột A: Dấu thời gian
            $table->string('student_code'); // Cột B: Mã HV
            $table->string('student_name'); // Cột C: Họ và Tên học viên
            $table->string('course_code'); // Cột D: Khóa
            $table->string('course_planed'); // Cột E: Khoá dự kiến Dành cho CSKH
            $table->date('birthday'); // Cột J Ngày sinh
            $table->string('address'); // Cột k Địa chỉ
            $table->string('telephone'); // Cột L Điện thoại
            $table->string('telephone2'); // Cột M SDT khác
            $table->string('id_student'); // Cột N Id student
            $table->string('date_give_card'); // Cột O Ngày cấp thẻ học nghề (ĐỐI VỚI BĐXN)
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
        Schema::dropIfExists('students');
    }
}
