<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicationAndTreatmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medication_and_treatments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_record_id')->unsigned()->nullable();
            $table->foreign('patient_record_id')->references('id')->on('patient_records')->onDelete('cascade');
            $table->string('medicine')->nullable();
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('medication_and_treatments');
    }
}
