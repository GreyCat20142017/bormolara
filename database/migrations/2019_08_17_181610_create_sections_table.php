<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionsTable extends Migration
{
     public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 24)->default('own');
            $table->boolean('hidden')->default(0);
            $table->boolean('own')->default(1);
        });
    }

     public function down()
    {
        Schema::dropIfExists('sections');
    }
}
