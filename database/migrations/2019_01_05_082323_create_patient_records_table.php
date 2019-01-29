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

            $table->string('case_no')->nullable();

            $table->integer('patient_id')->unsigned()->nullable();
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');

            $table->integer('type_of_record_id')->unsigned()->nullable();
            $table->foreign('type_of_record_id')->references('id')->on('type_of_records')->onDelete('cascade');

            $table->integer('admitted_and_check_up_by')->unsigned()->nullable();
            $table->foreign('admitted_and_check_up_by')->references('id')->on('users')->onDelete('cascade');
            $table->date('addmitted_and_check_up_date')->nullable();
            $table->time('addmitted_and_check_up_time')->nullable();

            $table->integer('discharge_by')->unsigned()->nullable();
            $table->foreign('discharge_by')->references('id')->on('users')->onDelete('cascade');
            $table->date('discharge_date')->nullable();
            $table->time('discharge_time')->nullable();

            $table->integer('attending_physician')->unsigned()->nullable();
            $table->foreign('attending_physician')->references('id')->on('users')->onDelete('cascade');

            $table->integer('chart_completed_by')->unsigned()->nullable();
            $table->foreign('chart_completed_by')->references('id')->on('users')->onDelete('cascade');

            $table->integer('room_id')->unsigned()->nullable();
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');

            $table->string('bed')->nullable();

            $table->integer('disposition_id')->unsigned()->nullable();
            $table->foreign('disposition_id')->references('id')->on('dispositions')->onDelete('cascade');

            $table->integer('philhealth_membership_id')->unsigned()->nullable();
            $table->foreign('philhealth_membership_id')->references('id')->on('philhealth_memberships')->onDelete('cascade');
            $table->string('sponsor')->nullable();

            $table->integer('result_id')->unsigned()->nullable();
            $table->foreign('result_id')->references('id')->on('results')->onDelete('cascade');

            $table->string('weight')->nullable();
            $table->string('height')->nullable();
            $table->string('temperature')->nullable();
            $table->string('blood_pressure')->nullable();
            $table->string('pulse_rate')->nullable();

            $table->boolean('discharged')->default(0);

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
        Schema::dropIfExists('patient_records');
    }
}
