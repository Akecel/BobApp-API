<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAddressTable extends Migration {

	public function up()
	{
		Schema::create('address', function(Blueprint $table) {
			$table->integer('user_id')->unique()->unsigned();
			$table->string('address');
			$table->integer('postal_code');
			$table->string('city');
			$table->string('country');
		});
	}

	public function down()
	{
		Schema::drop('address');
	}
}