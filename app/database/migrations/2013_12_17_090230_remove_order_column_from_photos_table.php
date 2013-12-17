<?php

use Illuminate\Database\Migrations\Migration;

class RemoveOrderColumnFromPhotosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('photos', function($table)
		{
			$table->dropColumn('order');
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
			$table->integer('order')->default(0)->after('description');
		});
	}

}