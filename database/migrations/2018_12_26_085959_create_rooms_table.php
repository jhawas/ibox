<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->integer('floor_id')->unsigned()->nullable();
            $table->foreign('floor_id')->references('id')->on('floors')->onDelete('cascade');
            $table->integer('room_type_id')->unsigned()->nullable();
            $table->foreign('room_type_id')->references('id')->on('room_types')->onDelete('cascade');
            $table->integer('capacity');
            $table->string('description');
            $table->integer('trans_user_id')->unsigned()->nullable();
            $table->foreign('trans_user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('rooms');
    }
}
