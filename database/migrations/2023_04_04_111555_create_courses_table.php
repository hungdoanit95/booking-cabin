<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->string('time_practice')->nullable(); // Cột P Giờ thực hành(Giờ)
            $table->text('address_practice')->nullable(); // Cột Q Địa điểm học thực hành
            $table->string('total_time')->nullable(); // Cột R Giờ thực hành
            $table->string('time_practiced')->nullable(); // Cột S "Giờ TH đã TT"
            $table->string('time_unpracticed')->nullable(); // Cột "Giờ TH chưa TT"
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
        Schema::dropIfExists('courses');
    }
}
