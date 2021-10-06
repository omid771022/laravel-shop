<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('coures_id')->unsigned();
            $table->bigInteger('season_id')->unsigned()->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('media_id')->unsigned()->nullable();
            $table->boolean('free')->default(false);
            $table->longText('body')->nullable();
            $table->enum('confirmationStatus', array_keys(\App\Lesson::$confirmationStatus))
            ->default('pending');
            $table->enum('status', array_keys(\App\Season::$statuses))->default('lock');
            $table->tinyInteger('time')->unsigned();
            $table->integer('proiority')->unsigned();
            $table->timestamps();

            $table->foreign('coures_id')->references('id')->on('courses')->onDelete('CASCADE');
            $table->foreign('season_id')->references('id')->on('seasons')->onDelete('SET NULL');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('media_id')->references('id')->on('media')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lessons');
    }
}
