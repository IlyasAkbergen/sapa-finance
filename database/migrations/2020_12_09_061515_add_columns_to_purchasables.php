<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToPurchasables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_course', function (Blueprint $table) {
            $table->unsignedTinyInteger('progress')
                ->after('score')
                ->default(0)
                ->index();
            $table->boolean('completed')
                ->after('progress')
                ->default(false)
                ->index();
        });

        Schema::table('user_briefcase', function (Blueprint $table) {
            $table->unsignedTinyInteger('progress')
                ->after('payed')
                ->default(0)
                ->index();
            $table->boolean('completed')
                ->after('progress')
                ->default(false)
                ->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_briefcase', function (Blueprint $table) {
            $table->dropIndex(['progress', 'completed']);
            $table->dropColumn('progress');
            $table->dropColumn('completed');
        });

        Schema::table('user_course', function (Blueprint $table) {
            $table->dropIndex(['progress', 'completed']);
            $table->dropColumn('progress');
            $table->dropColumn('completed');
        });
    }
}
