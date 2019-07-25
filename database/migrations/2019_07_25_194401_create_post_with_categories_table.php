<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostWithCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_with_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('post_id')->unsigned()->nullable();
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->bigInteger('post_category_id')->unsigned()->nullable();
            $table->foreign('post_category_id')->references('id')->on('post_categories')->onDelete('cascade');
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
        Schema::dropIfExists('post_with_categories');
    }
}
