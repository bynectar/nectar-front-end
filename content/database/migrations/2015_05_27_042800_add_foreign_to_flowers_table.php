<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignToFlowersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('flowers', function($table)
		{
			$table->integer('image_id')->unsigned()->nullable();
			$table->foreign('image_id')->references('id')->on('images');
			$table->integer('user_id')->unsigned()->nullable();
			$table->foreign('user_id')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('flowers', function($table)
		{
		    $table->dropForeign(['image_id','user_id']);
		    $table->dropColumn(['image_id','user_id']);
		});
	}

}
