<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterBriefcasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //        'sum', 'profit', 'duration',
//        'monthly_payment', 'direct_fee', 'awardable',
        Schema::table('briefcases', function (Blueprint $table) {
            $table->unsignedBigInteger('sum')
                ->nullable()
                ->default(0)
                ->change();
            $table->unsignedBigInteger('profit')
                ->nullable()
                ->default(0)
                ->change();
            $table->unsignedInteger('duration')
                ->nullable()
                ->default(0)
                ->change();
            $table->unsignedBigInteger('direct_fee')
                ->nullable()
                ->default(0)
                ->change();
            $table->timestamp('deleted_at')
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('briefcases', function (Blueprint $table) {
            $table->unsignedBigInteger('sum')
                ->default(0)
                ->change();
            $table->unsignedBigInteger('profit')
                ->default(0)
                ->change();
            $table->unsignedInteger('duration')
                ->default(0)
                ->change();
            $table->unsignedBigInteger('direct_fee')
                ->default(0)
                ->change();
            $table->dropColumn('deleted_at');
        });
    }
}
