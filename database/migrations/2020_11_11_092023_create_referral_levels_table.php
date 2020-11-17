<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferralLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referral_levels', function (Blueprint $table) {
            $table->unsignedTinyInteger('id', true);
            $table->string('title');
//            $table->unsignedInteger('reach_points')->nullable();
//            $table->unsignedInteger('reach_team_points')->nullable();
//            $table->unsignedInteger('defend_points')->nullable();
//            $table->unsignedInteger('defend_team_points')->nullable();
            $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('referral_levels');
    }
}
