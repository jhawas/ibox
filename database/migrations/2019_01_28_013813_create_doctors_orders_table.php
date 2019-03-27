<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorsOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_record_id')->unsigned()->nullable();
            $table->foreign('patient_record_id')->references('id')->on('patient_records')->onDelete('cascade');
            $table->integer('physician_id')->unsigned()->nullable();
            $table->foreign('physician_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('physician')->nullable();
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->string('progress_note')->nullable();
            $table->string('doctors_orders')->nullable();
            $table->string('laboratories')->nullable();
            $table->boolean('approved')->default(0);
            $table->integer('approved_by')->unsigned()->nullable();
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('doctors_orders');
    }
}
