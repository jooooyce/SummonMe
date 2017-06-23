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
			$table->string('username')->unique()->index();
			$table->string('email')->unique()->index();
	    	$table->string('password');
            $table->string('avatar')->default('default.jpg');
            $table->string('first_name',100);
            $table->string('last_name',100);
           	$table->string('phone_number', 10);
			$table->datetime('user_policy_accepted');
			$table->boolean('admin');
			$table->boolean('disabled');
            $table->rememberToken();
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
