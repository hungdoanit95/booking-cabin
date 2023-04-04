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
            $table->date('date_payout'); // Cột CL NGÀY NỘP TRUNG TÂM
            $table->integer('cabin_money'); // Cột CM TIỀN CABIN
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
