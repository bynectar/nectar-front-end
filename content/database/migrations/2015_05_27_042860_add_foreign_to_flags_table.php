<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignToFlagsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('flags', function($table)
		{
			$table->integer('review_id')->unsigned()->nullable();
			$table->foreign('review_id')->references('id')->on('reviews')->onDelete('cascade');
			$table->integer('thing_id')->unsigned()->nullable();
			$table->foreign('thing_id')->references('id')->on('things')->onDelete('cascade');
			$table->integer('comment_id')->unsigned()->nullable();
			$table->foreign('comment_id')->references('id')->on('comments')->onDelete('cascade');
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
		Schema::table('flags', function($table)
		{
		    $table->dropForeign(['review_id', 'user_id', 'thing_id','comment_id']);
		    $table->dropColumn(['review_id', 'user_id', 'thing_id','comment_id']);
		});
	}

}
