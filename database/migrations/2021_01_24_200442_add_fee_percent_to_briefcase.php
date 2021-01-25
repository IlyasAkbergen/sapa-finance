<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFeePercentToBriefcase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('briefcases', function (Blueprint $table) {
            $table->unsignedTinyInteger('fee_percent')
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('briefcases', function (Blueprint $table) {
            $table->dropColumn('fee_percent');
        });
    }
}
