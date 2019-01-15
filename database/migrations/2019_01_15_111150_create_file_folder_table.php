<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFileFolderTable extends Migration {

	public function up()
	{
		Schema::create('file_folder', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('file_id')->unsigned();
			$table->integer('folder_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('file_folder');
	}
}