<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPayoutIdToBalanceOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('balance_operations', function (Blueprint $table) {
            $table->unsignedBigInteger('payout_id')
                ->nullable()
                ->after('reward_id');
            $table->foreign('payout_id')
                ->references('id')
                ->on('payouts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('balance_operations', function (Blueprint $table) {
            $table->dropForeign(['payout_id']);
            $table->dropColumn('payout_id');
        });
    }
}
