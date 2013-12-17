<?php

use Illuminate\Database\Migrations\Migration;

class AddIsFavouriteColumnToPhotosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('photos', function($table)
		{
			$table->boolean('is_favourite')->nullable(false)->default(false)->after('id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('photos', function($table)
		{
			$table->dropColumn('is_favourite');
		});
	}

}