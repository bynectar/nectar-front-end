<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignToRatingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ratings', function($table)
		{
			$table->integer('review_id')->unsigned()->nullable();
			$table->foreign('review_id')->references('id')->on('reviews')->onDelete('cascade');
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ratings', function($table)
		{
		    $table->dropForeign(['rating_id', 'user_id']);
		    $table->dropColumn(['rating_id', 'user_id']);
		});
	}

}
