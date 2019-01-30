<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNursesNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nurses_notes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_record_id')->unsigned()->nullable();
            $table->foreign('patient_record_id')->references('id')->on('patient_records')->onDelete('cascade');
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->string('focus')->nullable();
            $table->string('data_action_response')->nullable();
            $table->integer('nurse_id')->unsigned()->nullable();
            $table->foreign('nurse_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('nurses_notes');
    }
}
