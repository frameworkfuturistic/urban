<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveyHoardingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survey_hoardings', function (Blueprint $table) {
            $table->id();
            $table->string('hoardingType');
            $table->string('HoardingCode');
            $table->string('HoldingNo');
            $table->string('Content');
            $table->string('Agency');
            $table->string('Location');
            $table->string('Longitude');
            $table->string('Latitude');
            $table->integer('Length');
            $table->integer('Width');
            $table->string('Image1');
            $table->string('Image2');
            $table->string('UserID');
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
        Schema::dropIfExists('survey_hoardings');
    }
}
