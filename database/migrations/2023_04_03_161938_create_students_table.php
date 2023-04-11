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
            $table->string('time_hidden')->nullable(); // Cột A: Dấu thời gian
            $table->string('student_code')->nullable(); // Cột B: Mã HV
            $table->string('student_name')->nullable(); // Cột C: Họ và Tên học viên
            $table->string('course_code')->nullable(); // Cột D: Khóa
            $table->string('course_planed')->nullable(); // Cột E: Khoá dự kiến Dành cho CSKH
            $table->string('birthday')->nullable(); // Cột J Ngày sinh
            $table->text('address')->nullable(); // Cột k Địa chỉ
            $table->string('telephone')->nullable(); // Cột L Điện thoại
            $table->string('telephone2')->nullable(); // Cột M SDT khác
            $table->string('id_student'); // Cột N Id student
            $table->string('date_give_card')->nullable(); // Cột O Ngày cấp thẻ học nghề (ĐỐI VỚI BĐXN)
            $table->string('exam_evenue')->nullable(); // Cột CK Địa điểm thi (máy đặt cabin). Một cabin sẽ đại diện cho 1 địa điểm và dựa vào địa điểm thi để cho học viên đăng ký sử dụng
            $table->string('exam_course')->nullable(); // Cột CL Khóa thi
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
