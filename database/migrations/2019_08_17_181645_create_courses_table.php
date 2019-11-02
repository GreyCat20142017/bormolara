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
            $table->string('name', 10)->default('own');
            $table->boolean('hidden')->default(0);
        });
    }

    public function down()
    {
        Schema::dropIfExists('courses');
    }
}

