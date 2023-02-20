<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToScholarshipLists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scholarship_lists', function (Blueprint $table) {
            $table->date('deadline')->after('remark');
            $table->integer('status')->after('deadline');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('scholarship_lists', function (Blueprint $table) {
            $table->dropColumn('deadline');
            $table->dropColumn('status');
        });
    }
}
