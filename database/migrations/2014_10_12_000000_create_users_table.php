<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('username',40)->nullable();
            $table->string('headline',40)->nullable();
            $table->text('bio',40)->nullable();
            $table->string('card_number',16)->nullable();
            $table->string('shaba',24)->nullable();

            $table->string('ip',80)->nullable();
            $table->string('telgram',50)->nullable();
            $table->string('mobile',11 )->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('status', array_keys(\App\User::$statues))->default('active');
            $table->bigInteger('image_id')->unsigned->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('image_id')->references('id')->on('media')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
