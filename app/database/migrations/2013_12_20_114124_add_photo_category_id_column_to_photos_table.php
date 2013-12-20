<?php

use Illuminate\Database\Migrations\Migration;

class AddPhotoCategoryIdColumnToPhotosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('photos', function($table)
		{
			$table->integer('photo_category_id')->nullable(false)->after('id');
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
			$table->dropColumn('photo_category_id');
		});
	}

}