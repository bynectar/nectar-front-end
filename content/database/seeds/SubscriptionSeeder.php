<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Subscription;

class SubscriptionSeeder extends Seeder {

	/**
	 * Run the admin seeder.
	 *
	 * @return void
	 */
	public function run()
	{
		
		// Create an instance of Faker
		$faker = Faker\Factory::create();
		
		for ($i=0;$i<30;$i++){
			
			$selector 		= $faker->numberBetween(1,3);
			$thing_id 		= null;
			$category_id 	= null;
			$author_id 		= null;
			if ($selector === 1){
				$thing_id = $faker->numberBetween(1,100);
			} elseif ($selector === 2){
				$category_id = $faker->numberBetween(1,10);
			} elseif ($selector === 3){
				$author_id = $faker->numberBetween(1,3);
			}
			
		    Subscription::create([
		        'thing_id'		=> $thing_id,
		        'category_id'	=> $category_id,
	            'author_id'		=> $author_id,
	            'user_id'		=> $faker->numberBetween(1,3)
		    ]);
		    
	    }
	    
	}

}
