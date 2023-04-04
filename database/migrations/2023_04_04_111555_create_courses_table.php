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
            $table->string('time_practice'); // Cột P Giờ thực hành(Giờ)
            $table->string('address_practice'); // Cột Q Địa điểm học thực hành
            $table->integer('total_time'); // Cột R Giờ thực hành
            $table->integer('time_practiced'); // Cột S "Giờ TH đã TT"
            $table->integer('time_unpracticed'); // Cột "Giờ TH chưa TT"
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
