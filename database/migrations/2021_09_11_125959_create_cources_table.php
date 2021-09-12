<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cources', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('teacher_id')->unsigned();
            $table->bigInteger('category_id')->unsigned();
            $table->string('title');
            $table->string('slug');
            $table->float('proiority')->nullable();
            $table->bigInteger('price', 10);
            $table->enum('type', ['free', 'cash']);
            $table->enum('enum', ['comp;eted','not-completed', 'lock']);
            $table->timestamps();


            $table->foreign('category_id')->references('id')->on('categories')->onDelete('SET NULL');
            $table->foreign('teacher_id')->references('id')->on('users')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cources');
    }
}
