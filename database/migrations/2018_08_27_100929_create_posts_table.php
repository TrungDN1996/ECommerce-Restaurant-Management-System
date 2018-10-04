<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type', ['post', 'post_product']);
            $table->string('slug');
            $table->string('title');
            $table->string('excerpt');
            $table->integer('thumbnail')->unsigned()->nullable();
            $table->text('content');
            $table->boolean('published')->unsigned(); // 0: draft, 1: published
            $table->boolean('preview')->unsigned()->nullable();
            $table->boolean('allow_comment')->unsigned()->default(1);
            $table->integer('product_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned();
            $table->integer('category_id')->unsigned()->nullable();
            $table->softDeletes();
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('thumbnail')->references('id')->on('files');
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
        Schema::dropIfExists('comments');
        Schema::dropIfExists('posts');
    }
}
