<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		// $this->call('UserTableSeeder');
		$this->call('AdminSeeder');
		$this->call('CategorySeeder');
		$this->call('ThingSeeder');
		$this->call('ReviewSeeder');
		$this->call('CommentSeeder');
		$this->call('FlagSeeder');
		$this->call('SubscriptionSeeder');
		$this->call('VoteSeeder');

	}

}
