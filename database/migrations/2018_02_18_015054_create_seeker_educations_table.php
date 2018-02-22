<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeekerEducationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seeker_educations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('seeker_id')->unsigned();
            $table->string('university');
            $table->string('type');
            $table->string('title');
            $table->date('achieved');
            
            $table->timestamps();
            
            $table->foreign('seeker_id')->references('user_id')->on('seekers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seeker_educations');
    }
}
