<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentEducationalDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_educational_details', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->integer('year_id')->nullable();
            $table->integer('department_id')->nullable();
            $table->integer('course_id')->nullable();
            $table->integer('division_id')->nullable();
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
        Schema::dropIfExists('student_educational_details');
    }
}
