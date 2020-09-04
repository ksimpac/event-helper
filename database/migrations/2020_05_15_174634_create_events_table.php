<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id('event_id');
            $table->string('title');
            $table->string('slogan');
            $table->longText('moreInfo');
            $table->dateTime('dateStart');
            $table->dateTime('dateEnd');
            $table->dateTime('enrollDeadline');
            $table->string('location');
            $table->unsignedBigInteger('maximum');
            $table->string('imageName');
            $table->enum('type', ['系會', '系辦', '校內', '校外']);
            $table->enum('poster', ['系辦', '系會']);
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
        Schema::dropIfExists('events');
    }
}
