<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicineStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicine_stocks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('description');
            $table->integer('quantity');
            $table->decimal('price', 8, 2);
            $table->integer('medicine_type_id')->unsigned()->nullable();
            $table->foreign('medicine_type_id')->references('id')->on('medicine_types')->onDelete('cascade');
            $table->integer('mass_volume_type_id')->unsigned()->nullable();
            $table->foreign('mass_volume_type_id')->references('id')->on('mass_volume_types')->onDelete('cascade');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('medicine_stocks');
    }
}
