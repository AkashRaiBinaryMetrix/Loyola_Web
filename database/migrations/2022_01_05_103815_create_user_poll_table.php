<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPollTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_poll', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('community_id')->nullable();
            $table->string('title')->nullable();
            $table->longText('question')->nullable();
            $table->longText('option')->nullable();
            $table->integer('multiple')->nullable();
            $table->integer('status')->nullable();
            $table->longText('report')->nullable();
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
        Schema::dropIfExists('user_poll');
    }
}
