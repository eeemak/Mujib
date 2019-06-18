<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fullname');
            $table->string('username');
            $table->integer('districts_id');
            $table->integer('thanas_id');
            $table->integer('policeStations_id');
            $table->string('parmanentAddress')->nullable();
            $table->string('presentAddress')->nullable();
            $table->string('aboutSelf')->nullable();
            $table->string('photoPath')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreign('districts_id')->references('id')->on('districts')->onDelete('cascade');
            $table->foreign('thanas_id')->references('id')->on('thanas')->onDelete('cascade');
            $table->foreign('policeStations_id')->references('id')->on('police_stations')->onDelete('cascade');
            $table->string('addedFromIp')->nullable();
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
        Schema::dropIfExists('users');
    }
}
