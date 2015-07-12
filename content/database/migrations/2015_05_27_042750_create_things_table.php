<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('things', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->timestamp('published_at')->nullable();
			$table->softDeletes();
			$table->string('title');
			$table->longText('description');
			$table->integer('votes_count')->default(0);
			$table->integer('flags_count')->default(0);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('things');
	}

}
