<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type', ['online', 'table']);
            $table->tinyInteger('people')->unsigned()->default(1); // ( min: 1 max: 255 )
            $table->enum('ship', ['free', 'fast'])->nullable();
            $table->text('note')->nullable();
            $table->enum('status', ['unconfirmed', 'confirmed']);
            $table->integer('total')->unsigned(); // ( min: 0 , max: 65536 )
            $table->boolean('paid')->unsigned();
            $table->datetime('received_at');
            $table->integer('service_id')->unsigned()->nullable();
            $table->integer('coupon_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned();
            $table->foreign('service_id')->references('id')->on('services');
            $table->foreign('coupon_id')->references('id')->on('coupons');
            $table->foreign('user_id')->references('id')->on('users');
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
    }
}
