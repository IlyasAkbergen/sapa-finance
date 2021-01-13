<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPurchaseIdToUserBriefcaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_briefcase', function (Blueprint $table) {
            $table->unsignedBigInteger('purchase_id')
                ->after('consultant_id')
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
        Schema::table('user_briefcase', function (Blueprint $table) {
            $table->dropColumn('purchase_id');
        });
    }
}
