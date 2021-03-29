<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassNameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_name', function (Blueprint $table) {
            $table->unsignedInteger('sno');
            $table->char('DEP_ID', 6);
            $table->char('SCH_DEP', 3);
            $table->char('CID', 3);
            $table->char('SCH_TYPE', 3);
            $table->char('DEP_ABBR', 5);
            $table->char('DEP_NAME', 20);
            $table->char('class_no', 10);
            $table->primary('sno');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_name');
    }
}
