<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReferrerToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('referrer_id')
                ->nullable()
                ->after('role_id');

            $table->foreign('referrer_id')
                ->references('id')
                ->on('users');

            $table->unsignedBigInteger('root_referrer_id')
                ->nullable()
                ->after('referrer_id');

            $table->foreign('root_referrer_id')
                ->references('id')
                ->on('users');

            $table->unsignedTinyInteger('fee_percent')
                ->nullable()
                ->after('referral_level_id');
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
            $table->dropForeign(['referrer_id']);
            $table->dropColumn('referrer_id');
        });
    }
}
