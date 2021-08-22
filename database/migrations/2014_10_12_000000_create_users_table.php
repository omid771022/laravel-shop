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
            $table->string('website',90)->nullable();
            $table->string('linkedin',80)->nullable();
            $table->string('tiwitter',70)->nullable();
            $table->string('telgram',50)->nullable();
            $table->string('mobile',11 )->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('status',['active','inactive','ban' ])->default('active');
            $table->rememberToken();
            $table->timestamps();
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
