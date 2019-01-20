<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFilesTypesTable extends Migration {

	public function up()
	{
		Schema::create('files_types', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title');
			$table->integer('folder_categorie_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('files_types');
	}
}