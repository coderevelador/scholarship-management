<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddApprovedAmountToAppliedScholarships extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('applied_scholarships', function (Blueprint $table) {
            $table->integer('approved_amount')->after('submission_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('applied_scholarships', function (Blueprint $table) {
            $table->dropColumn('approved_amount');
        });
    }
}
