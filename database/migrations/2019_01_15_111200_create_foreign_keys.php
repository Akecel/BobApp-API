<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('user_info', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('files', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('files', function(Blueprint $table) {
			$table->foreign('filetype_id')->references('id')->on('files_types')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('folders', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('address', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('file_folder', function(Blueprint $table) {
			$table->foreign('file_id')->references('id')->on('files')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('file_folder', function(Blueprint $table) {
			$table->foreign('folder_id')->references('id')->on('folders')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('files_types', function(Blueprint $table) {
			$table->foreign('foldercategorie_id')->references('id')->on('folders_categories')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
	}

	public function down()
	{
		Schema::table('user_info', function(Blueprint $table) {
			$table->dropForeign('user_info_user_id_foreign');
		});
		Schema::table('files', function(Blueprint $table) {
			$table->dropForeign('files_user_id_foreign');
		});
		Schema::table('files', function(Blueprint $table) {
			$table->dropForeign('files_filetype_id_foreign');
		});
		Schema::table('folders', function(Blueprint $table) {
			$table->dropForeign('folders_user_id_foreign');
		});
		Schema::table('address', function(Blueprint $table) {
			$table->dropForeign('address_user_id_foreign');
		});
		Schema::table('file_folder', function(Blueprint $table) {
			$table->dropForeign('file_folder_file_id_foreign');
		});
		Schema::table('file_folder', function(Blueprint $table) {
			$table->dropForeign('file_folder_folder_id_foreign');
		});
		Schema::table('files_types', function(Blueprint $table) {
			$table->dropForeign('files_types_foldercategorie_id_foreign');
		});
	}
}