<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBriefcaseChangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('briefcase_changes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('briefcase_id');
            $table->unsignedBigInteger('partner_id');
            $table->json('change_data')
                ->nullable();
            $table->unsignedTinyInteger('status')
                ->default(1);
            $table->unsignedTinyInteger('type_id');
            $table->timestamp('deleted_at')
                ->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('briefcase_changes');
    }
}
