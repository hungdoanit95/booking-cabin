<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGiftAndTimeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gift_and_time', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->string('books')->nullable(); // Cột AC Phát sách 600 câu
            $table->string('gifts')->nullable(); // Cột AD Quà tặng (nếu có)
            $table->string('tuition_solid')->nullable(); // Cột AE HỌC PHÍ CHUẨN
            $table->string('money_discount_fullmoney')->nullable(); // Cột AF ĐÓNG HẾT HỌC PHÍ GIẢM TIỀN
            $table->string('money_discount_in')->nullable(); // Cột AG TIỀN GIẢM TRONG CHƯƠNG TRÌNH
            $table->string('money_discount_ex')->nullable(); // TIỀN GIẢM NGOÀI CHƯƠNG TRÌNH
            $table->string('reg_group')->nullable(); // GIẢM ĐĂNG KÝ NHÓM/ GIỚI THIỆU
            $table->string('total_tuition')->nullable(); // TỔNG HỌC PHÍ SAU GIẢM
            $table->string('compare')->nullable(); // ĐỐI CHIẾU
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
        Schema::dropIfExists('gift_and_time');
    }
}
