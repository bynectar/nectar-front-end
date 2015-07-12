<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignToReviewsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('reviews', function($table)
		{
			$table->integer('rating_id')->unsigned()->nullable();
			$table->foreign('rating_id')->references('id')->on('ratings');
			$table->integer('thing_id')->unsigned()->nullable();
			$table->foreign('thing_id')->references('id')->on('things')->onDelete('cascade');
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
		Schema::table('reviews', function($table)
		{
		    $table->dropForeign(['rating_id', 'thing_id', 'user_id']);
		    $table->dropColumn(['rating_id', 'thing_id', 'user_id']);
		});
	}

}
