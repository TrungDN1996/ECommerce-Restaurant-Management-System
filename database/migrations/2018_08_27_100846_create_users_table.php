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
            $table->increments('id');
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('avatar')->default('media/image/user-default.png'); // url
            $table->string('address')->nullable();
            $table->string('phone',15)->nullable();
            $table->enum('type', ['local', 'traveller'])->default('local');
            $table->enum('status', ['new', 'old', 'loyal'])->default('new');
            $table->enum('role', ['user', 'admin'])->default('user');
            $table->boolean('activate')->unsigned()->default(0);
            $table->datetime('last_login')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('orders');
        Schema::dropIfExists('comments');
        Schema::dropIfExists('users');
    }
}
