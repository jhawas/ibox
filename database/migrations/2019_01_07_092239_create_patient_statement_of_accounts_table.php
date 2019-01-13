<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientStatementOfAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_statement_of_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_record_id')->unsigned()->nullable();
            $table->foreign('patient_record_id')->references('id')
                    ->on('patient_records')
                    ->onDelete('cascade');
            $table->integer('type_of_charge_id')->unsigned()->nullable();
            $table->foreign('type_of_charge_id')->references('id')
                    ->on('type_of_charges')
                    ->onDelete('cascade');
            $table->decimal('price', 8, 2)->nullable();
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
        Schema::dropIfExists('patient_statement_of_accounts');
    }
}
