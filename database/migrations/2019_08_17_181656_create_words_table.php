<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWordsTable extends Migration
{

    public function up()
    {
        Schema::create('words', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('course_id')->default(1);
            $table->string('english', 32)->default('');
            $table->string('russian', 160)->default('');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('CASCADE');
        });
    }


    public function down()
    {
        Schema::dropIfExists('words');
    }
}
