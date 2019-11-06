<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveyCsvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survey_csvs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('survey_uuid')->nullable();
            $table->string('ipad_udid')->nullable();
            $table->integer('section_group')->nullable();
            $table->text('section')->nullable();
            $table->text('question')->nullable();
            $table->text('answer')->nullable();
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
        Schema::dropIfExists('survey_csvs');
    }
}
