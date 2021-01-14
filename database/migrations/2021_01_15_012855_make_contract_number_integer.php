å<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeContractNumberInteger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_briefcase', function (Blueprint $table) {
            $table->unsignedBigInteger('contract_number')
                ->nullable()
                ->default(null)
                ->change();
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
            $table->string('contract_number')
                ->nullable()
                ->change();
        });
    }
}
