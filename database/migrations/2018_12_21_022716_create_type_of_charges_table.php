<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypeOfChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_of_charges', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->nullable();
            $table->string('description')->nullable();
            $table->decimal('price', 8, 2)->nullable();
            $table->integer('parent_id')->unsigned()->nullable();
            $table->foreign('parent_id')->references('id')->on('type_of_charges')->onDelete('cascade');
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
        Schema::dropIfExists('type_of_charges');
    }
}
