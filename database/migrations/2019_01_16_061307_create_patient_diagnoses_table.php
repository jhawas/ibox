<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientDiagnosesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_diagnoses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('diagnose_id')->unsigned()->nullable();
            $table->foreign('diagnose_id')->references('id')->on('diagnoses')->onDelete('cascade');
            $table->integer('patient_record_id')->unsigned()->nullable();
            $table->foreign('patient_record_id')->references('id')->on('patient_records')->onDelete('cascade');
            $table->string('weight')->nullable();
            $table->string('height')->nullable();
            $table->string('temperature')->nullable();
            $table->string('blood_pressure')->nullable();
            $table->string('pulse_rate')->nullable();
            $table->string('description')->nullable();
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
        Schema::dropIfExists('patient_diagnoses');
    }
}
