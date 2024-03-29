<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->unsignedBigInteger('event_id');
            $table->foreign('event_id')->references('event_id')->on('events')
                ->constrained()->onDelete('cascade');
            $table->string('STU_ID');
            $table->string('identify');
            $table->string('NAME');
            $table->primary(['event_id', 'STU_ID']);
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
        Schema::dropIfExists('participants');
    }
}
