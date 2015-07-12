<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignToSubscriptionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('subscriptions', function($table)
		{
			$table->integer('thing_id')->unsigned()->nullable();
			$table->foreign('thing_id')->references('id')->on('things')->onDelete('cascade');
			$table->integer('category_id')->unsigned()->nullable();
			$table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
			$table->integer('author_id')->unsigned()->nullable();
			$table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
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
		Schema::table('subscriptions', function($table)
		{
		    $table->dropForeign(['thing_id', 'category_id', 'author_id', 'user_id']);
		    $table->dropColumn(['thing_id', 'category_id', 'author_id', 'user_id']);
		});
	}

}
