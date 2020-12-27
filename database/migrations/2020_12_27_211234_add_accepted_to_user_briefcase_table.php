å<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAcceptedToUserBriefcaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_briefcase', function (Blueprint $table) {
            $table->boolean('accepted')
                ->after('status')
                ->default(false);
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
            $table->dropColumn('accepted');
        });
    }
}
