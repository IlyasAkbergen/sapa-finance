<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRewardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rewards', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('target_user_id');
            $table->foreign('target_user_id')
                ->references('id')
                ->on('users');

            $table->unsignedBigInteger('purchase_id')
                ->nullable();
            $table->foreign('purchase_id')
                ->references('id')
                ->on('purchases');

            $table->boolean('is_direct');

            $table->bigInteger('sum')
                ->nullable();

            $table->integer('points')
                ->nullable();

            $table->boolean('handled')
                ->default(false)
                ->index();

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
        Schema::dropIfExists('rewards');
    }
}
