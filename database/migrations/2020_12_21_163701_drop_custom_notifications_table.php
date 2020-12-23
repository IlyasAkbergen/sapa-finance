<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropCustomNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('user_notification');
        Schema::dropIfExists('notifications');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content')
                ->nullable();
            $table->string('url')
                ->nullable();
            $table->boolean('is_public')
                ->default(true);
            $table->timestamps();
        });

        Schema::create('user_notification', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->unsignedBigInteger('notification_id');
            $table->foreign('notification_id')
                ->references('id')
                ->on('notifications');

            $table->boolean('seen')
                ->default(false);

            $table->timestamps();
        });
    }
}
