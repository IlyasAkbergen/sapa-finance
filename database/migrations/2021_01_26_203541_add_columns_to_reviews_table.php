<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->foreignId('from_id')
                ->references('id')
                ->on('users');

            $table->foreignId('to_id')
                ->references('id')
                ->on('users');

            $table->text('content')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign(['from_id']);
            $table->dropColumn('from_id');
            $table->dropForeign(['to_id']);
            $table->dropColumn('to_id');
            $table->dropColumn('content');
        });
    }
}
