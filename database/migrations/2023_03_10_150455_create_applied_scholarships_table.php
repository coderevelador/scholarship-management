<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppliedScholarshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applied_scholarships', function (Blueprint $table) {
            $table->id();
            $table->integer('scholarship_id');
            $table->integer('student_id');
            $table->string('annual_income');
            $table->string('mark_percentage');
            $table->date('submission_date');
            $table->enum('status', ['pending', 'inprogress', 'approved', 'rejected'])->default('pending');
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
        Schema::dropIfExists('applied_scholarships');
    }
}
