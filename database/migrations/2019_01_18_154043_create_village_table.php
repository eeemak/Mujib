<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVillageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('villages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('district_id');
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');
            $table->integer('thana_id');
            $table->foreign('thana_id')->references('id')->on('thanas')->onDelete('cascade');
            $table->integer('police_station_id');
            $table->foreign('police_station_id')->references('id')->on('police_stations')->onDelete('cascade');
            $table->string('name');
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
        Schema::dropIfExists('village');
    }
}
