<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFoldersCategoriesTable extends Migration {

	public function up()
	{
		Schema::create('folders_categories', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title');
		});
	}

	public function down()
	{
		Schema::drop('folders_categories');
	}
}