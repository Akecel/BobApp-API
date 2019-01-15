<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserInfoTable extends Migration {

	public function up()
	{
		Schema::create('user_info', function(Blueprint $table) {
			$table->integer('user_id')->unsigned();
			$table->string('lastName');
			$table->string('firstName');
			$table->string('birthdate');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('user_info');
	}
}