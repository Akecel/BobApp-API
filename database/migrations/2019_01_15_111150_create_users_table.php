<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	public function up()
	{
		Schema::create('users', function(Blueprint $table) {
			$table->increments('id');
			$table->string('phone_number')->unique();
			$table->string('email')->nullable();
			$table->string('password', 60)->nullable();
			$table->string('lastName')->nullable();
			$table->string('firstName')->nullable();
			$table->string('birthdate')->nullable();
			$table->boolean('admin')->default(0);
			$table->rememberToken('rememberToken');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('users');
	}
}