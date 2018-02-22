<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeekersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seekers', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->string('name', 100)->default('');
            $table->string('phone', 11)->default('');
            $table->string('city')->default('');
            $table->string('state')->default('');
            $table->string('zipcode')->default('');
            $table->integer('age')->nullable();
            $table->timestamps();
            
            $table->primary('user_id');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seekers');
    }
}
