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
			$table->string('lastName');
			$table->string('firstName');
			$table->string('birthdate');
			$table->string('address');
			$table->integer('postcode');
			$table->string('city');
			$table->string('country');
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