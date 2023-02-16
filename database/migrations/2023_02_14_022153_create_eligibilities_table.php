<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEligibilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eligibilities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('income');
            $table->integer('minimumPercentage');
            $table->string('minimumMarkPercentage');
            $table->string('percentageCondition');
            $table->string('maximumMarkPercentage');
            $table->string('eligibleAmount');
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
        Schema::dropIfExists('eligibilities');
    }
}
