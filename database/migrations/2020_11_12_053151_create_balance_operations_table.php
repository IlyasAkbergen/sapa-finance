<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBalanceOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balance_operations', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('target_balance_id');
            $table->foreign('target_balance_id')
                ->references('id')
                ->on('balances');

            $table->unsignedBigInteger('purchase_id')
                ->nullable();
            $table->foreign('purchase_id')
                ->references('id')
                ->on('purchases');

            $table->bigInteger('sum')
                ->nullable();
            $table->integer('points')
                ->nullable();
            $table->integer('team_points')
                ->nullable();

            $table->boolean('committed')
                ->default(false);

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
        Schema::dropIfExists('balance_operations');
    }
}
