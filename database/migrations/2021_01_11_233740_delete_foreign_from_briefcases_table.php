<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteForeignFromBriefcasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('briefcases', function (Blueprint $table) {
            $table->dropForeign('briefcases_partner_id_foreign');
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
            $table->foreign('partner_id')
                ->references('id')
                ->on('partners');
        });
    }
}
