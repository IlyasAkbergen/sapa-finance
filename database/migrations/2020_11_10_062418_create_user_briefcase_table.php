<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserBriefcaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_briefcase', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->unsignedBigInteger('briefcase_id');
            $table->foreign('briefcase_id')
                ->references('id')
                ->on('briefcases');

            $table->unsignedBigInteger('consultant_id');
            $table->foreign('consultant_id')
                ->references('id')
                ->on('users');

            $table->unsignedTinyInteger('status')
                ->default(1);
            $table->boolean('payed')
                ->default(false);

            $table->index(['status', 'payed']);

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
        Schema::dropIfExists('user_briefcase');
    }
}
