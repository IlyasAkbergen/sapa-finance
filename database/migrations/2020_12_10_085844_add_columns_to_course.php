<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToCourse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->boolean('is_offline')
                ->default(false)
                ->after('is_online');

            $table->unsignedTinyInteger('direct_points')
                ->after('direct_fee')
                ->default(0);

            $table->unsignedTinyInteger('team_points')
                ->after('direct_points')
                ->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('team_points');
            $table->dropColumn('direct_points');
            $table->dropColumn('is_offline');
        });
    }
}
