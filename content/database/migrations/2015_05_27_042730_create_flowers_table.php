<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlowersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('flowers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->timestamp('published_at')->nullable();
			$table->string('common_name_1')->nullable();
			$table->string('common_name_2')->nullable();
			$table->string('common_name_3')->nullable();
			$table->string('latin_name')->nullable();
			$table->longText('description')->nullable();
			$table->json('colors')->nullable();
			$table->boolean('branches')->default(false)->nullable();
			$table->boolean('berries')->default(false)->nullable();
			$table->boolean('foliage')->default(false)->nullable();
			$table->boolean('spring')->default(false)->nullable();
			$table->boolean('summer')->default(false)->nullable();
			$table->boolean('fall')->default(false)->nullable();
			$table->boolean('winter')->default(false)->nullable();
			$table->string('image_mime')->nullable();
			$table->string('image_filename')->nullable();
			$table->string('image_title')->nullable();
			$table->longText('image_desc')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('flowers');
	}

}
