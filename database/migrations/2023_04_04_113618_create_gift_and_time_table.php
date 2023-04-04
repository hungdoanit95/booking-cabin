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
            $table->integer('books'); // Cột AC Phát sách 600 câu
            $table->string('gifts'); // Cột AD Quà tặng (nếu có)
            $table->string('tuition_solid'); // Cột AE HỌC PHÍ CHUẨN
            $table->string('money_discount_fullmoney'); // Cột AF ĐÓNG HẾT HỌC PHÍ GIẢM TIỀN
            $table->string('money_discount_in'); // Cột AG TIỀN GIẢM TRONG CHƯƠNG TRÌNH
            $table->string('money_discount_ex'); // TIỀN GIẢM NGOÀI CHƯƠNG TRÌNH
            $table->string('reg_group'); // GIẢM ĐĂNG KÝ NHÓM/ GIỚI THIỆU
            $table->string('total_tuition'); // TỔNG HỌC PHÍ SAU GIẢM
            $table->string('compare'); // ĐỐI CHIẾU
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
