<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScholarshipListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scholarship_lists', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('academic_year_id');
            $table->integer('institution_id');
            $table->integer('department_id');
            $table->integer('course_id');
            $table->integer('division_id');
            $table->integer('eligibility_id');
            $table->string('cover_image');
            $table->text('remark')->nullable();
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
        Schema::dropIfExists('scholarship_lists');
    }
}
