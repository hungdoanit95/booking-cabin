<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoneyCabin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('money_cabin', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->date('date_payout')->nullable(); // Cột CL NGÀY NỘP TRUNG TÂM
            $table->string('cabin_money')->nullable(); // Cột CM TIỀN CABIN
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
        Schema::dropIfExists('money_cabin');
    }
}
