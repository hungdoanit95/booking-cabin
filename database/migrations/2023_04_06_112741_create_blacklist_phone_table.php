<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlacklistPhoneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blacklist_phone', function (Blueprint $table) {
            $table->id();
            $table->string('telephone');
            $table->integer('status')->default(0); // Nếu là 0: thì số không thể gửi và chỉ mới nhấn 1 lần 
            // là 1: thì là đã điền vào form trên 1 lần và đã bị khóa
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
        Schema::dropIfExists('blacklist_phone');
    }
}
