<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned()->default(1);
            $table->string('name', 32)->default('own');
            $table->boolean('hidden')->default(0);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
        });
    }

    public function down()
    {
        Schema::dropIfExists('courses');
    }
}

