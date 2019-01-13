<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_records', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->integer('record_type_id')->unsigned()->nullable();
            $table->foreign('record_type_id')->references('id')->on('record_types')->onDelete('cascade');

            $table->integer('room_id')->unsigned()->nullable();
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
            
            $table->integer('trans_user_id')->unsigned()->nullable();
            $table->foreign('trans_user_id')->references('id')->on('users')->onDelete('cascade');

            $table->datetime('started_at');

            $table->datetime('end_at');
            
            $table->string('description');

            $table->boolean('isReleased')->default(0);

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
        Schema::dropIfExists('patient_records');
    }
}