<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteFkFromMessages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_message', function (Blueprint $table) {
            $table->dropForeign('user_message_message_id_foreign');
            $table->dropForeign('user_message_user_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_message', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->foreign('message_id')
                ->references('id')
                ->on('messages');
        });
    }
}
