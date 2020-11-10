<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBalanceToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('balance')
                ->after('two_factor_recovery_codes')
                ->default(0);

            $table->unsignedBigInteger('points')
                ->nullable()
                ->after('balance');

            $table->unsignedBigInteger('team_points')
                ->nullable()
                ->after('points');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['balance', 'points', 'team_points']);
        });
    }
}
