<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubtaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subtask', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('task')->unsigned();
            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('done');
            $table->timestamps();
            $table->foreign('task')->references('id')->on('task');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subtask');
    }
}
