<?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreatePhrasesTable extends Migration {
        public function up() {
            Schema::create('phrases', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('section_id')->default(1);
                $table->unsignedBigInteger('user_id')->default(1);
                $table->string('english', 255)->default('');
                $table->string('russian', 255)->default('');
                $table->foreign('section_id')->references('id')->on('sections')->onDelete('CASCADE');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
            });
        }


        public function down() {
            Schema::dropIfExists('phrases');
        }
    }
