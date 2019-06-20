<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserInstitutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_institutions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('instituteName',150)->nullable();
            $table->string('position',50)->nullable();
            $table->dateTime('joiningDate')->nullable();
            $table->dateTime('endDate')->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('profession_type_id')->unsigned()->nullable();
            $table->foreign('profession_type_id')->references('id')->on('profession_types')->onDelete('cascade');
            $table->text('Address')->nullable();
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
        Schema::dropIfExists('user_institutions');
    }
}
