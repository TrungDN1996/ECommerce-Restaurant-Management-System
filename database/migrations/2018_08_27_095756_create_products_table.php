<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->enum('type', ['drink', 'appetizer', 'entree', 'dessert']);
            $table->boolean('status')->unsigned()->default(1); // 0: off 1: on
            $table->integer('price')->unsigned();  // unit: 1$ - 9 999 $
            $table->integer('category_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->softDeletes();
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
        Schema::dropIfExists('orderDetails');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('posts');
        Schema::dropIfExists('products');
    }
}
