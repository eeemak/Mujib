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
            $table->integer('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigIncrements('professionType_id')->nullable();
            $table->foreign('professionType_id')->references('id')->on('professionType')->onDelete('cascade');
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
