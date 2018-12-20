<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->datetime('birthdate')->nullable();
            $table->string('about')->nullable();
            $table->string('sex')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('work')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('address')->nullable();
            $table->string('address2')->nullable();
            $table->string('password')->nullable();
            $table->string('avatar')->nullable();
            $table->timestamp('email_verified_at')->nullable();
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
