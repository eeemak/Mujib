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
            $table->string('InstituteName',150)->nullable();
            $table->string('Position',50)->nullable();
            $table->dateTime('JoiningDate')->nullable();
            $table->dateTime('EndDate')->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('ProfessionTypeId')->unsigned()->nullable();
            $table->text('Address')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ProfessionTypeId')->references('id')->on('profession_types')->onDelete('cascade');
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
