<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddChallangesColumnsToReferralLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('referral_levels', function (Blueprint $table) {
            $table->json('achieve_challenges')
                ->nullable();
            $table->json('remain_challenges')
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
        Schema::table('referral_levels', function (Blueprint $table) {
            $table->dropColumn('remain_challenges')
                ->nullable();
            $table->dropColumn('achieve_challenges')
                ->nullable();
        });
    }
}
