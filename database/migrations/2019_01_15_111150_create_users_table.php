<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	public function up()
	{
		Schema::create('users', function(Blueprint $table) {
			$table->increments('id');
			$table->string('phone_number')->unique();
			$table->string('email')->default('NULL');
			$table->string('password', 60)->default('NULL');
			$table->string('lastName')->default('NULL');
			$table->string('firstName')->default('NULL');
			$table->string('birthdate')->default('NULL');
			$table->string('address')->default('NULL');
			$table->integer('postcode')->default('NULL');
			$table->string('city')->default('NULL');
			$table->string('country')->default('NULL');
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