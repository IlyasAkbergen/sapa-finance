<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('short_description', 500)
                ->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_online');
            $table->unsignedInteger('price_without_feedback');
            $table->unsignedInteger('price_with_feedback');
            $table->unsignedInteger('direct_points');
            $table->unsignedInteger('team_points');
            $table->unsignedInteger('direct_fee');
            $table->unsignedInteger('team_fee');
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
        Schema::dropIfExists('courses');
    }
}
