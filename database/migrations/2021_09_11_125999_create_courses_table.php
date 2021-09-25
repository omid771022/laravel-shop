<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('teacher_id')->unsigned();
            $table->bigInteger('category_id')->nullable()->unsigned();
            $table->string('title');
            $table->string('slug');
            $table->float('proiority')->nullable();
            $table->bigInteger('price');
            $table->enum('type', array_keys(\App\Course::$types));
            $table->enum('enum', array_keys(\App\Course::$enums));
            $table->longText('body')->nullable();
            $table->integer('banner_id')->nullable()->unsigned();
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('SET NULL');
            $table->foreign('teacher_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('teacher_id')->references('id')->on('media')->onDelete('CASCADE');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
