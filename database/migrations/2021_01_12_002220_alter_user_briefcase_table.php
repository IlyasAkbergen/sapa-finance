<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUserBriefcaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_briefcase', function (Blueprint $table) {
            $table->unsignedBigInteger('sum')
                ->nullable()
                ->default(0);
            $table->unsignedBigInteger('profit')
                ->nullable()
                ->default(0);
            $table->unsignedInteger('duration')
                ->nullable()
                ->default(0);
            $table->unsignedInteger('monthly_payment')
                ->nullable()
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
        Schema::table('user_briefcase', function (Blueprint $table) {
            $table->dropColumn('sum');
            $table->dropColumn('profit');
            $table->dropColumn('duration');
            $table->dropColumn('monthly_payment');
        });
    }
}
