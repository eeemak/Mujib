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
            $table->renameColumn('name', 'fullname');
            $table->string('username');
            $table->bigInteger('district_id')->unsigned();
            $table->bigInteger('thana_id')->unsigned();
            $table->bigInteger('police_station_id')->unsigned();
            $table->string('parmanentAddress')->nullable();
            $table->string('presentAddress')->nullable();
            $table->string('aboutSelf')->nullable();
            $table->string('photoPath')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');
            $table->foreign('thana_id')->references('id')->on('thanas')->onDelete('cascade');
            $table->foreign('police_station_id')->references('id')->on('police_stations')->onDelete('cascade');
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
