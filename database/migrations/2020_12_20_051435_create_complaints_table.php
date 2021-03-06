<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('from_id');
            $table->foreign('from_id')
                ->references('id')
                ->on('users');

            $table->unsignedBigInteger('to_id');
            $table->foreign('to_id')
                ->references('id')
                ->on('users');

            $table->text('content')->nullable();

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
        Schema::dropIfExists('complaints');
    }
}
