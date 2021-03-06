<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFoldersCategoriesTable extends Migration {

	public function up()
	{
		Schema::create('folders_categories', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title');
			$table->string('icon');
			$table->string('description');
			$table->string('extended_description');
		});
	}

	public function down()
	{
		Schema::drop('folders_categories');
	}
}