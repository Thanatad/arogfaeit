<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('short_des', 70);
            $table->text('description');
            $table->integer('budget');
            $table->integer('count_day');
            $table->string('day');
            $table->date('start');
            $table->date('end');
            $table->time('timestart');
            $table->string('mobile', 13);
            $table->string('email');
            $table->text('highlight');
            $table->text('hashtag');
            $table->string('picture')->nullable();
            $table->integer('assign')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
