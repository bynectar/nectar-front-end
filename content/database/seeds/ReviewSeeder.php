<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Review;
use App\Models\Rating;

class ReviewSeeder extends Seeder {

	/**
	 * Run the admin seeder.
	 *
	 * @return void
	 */
	public function run()
	{
		
		// Create an instance of Faker
		$faker = Faker\Factory::create();
		
		for ($i=0;$i<100;$i++){
			
			// Create a review
		    $review = Review::create([
		        'title'			=> $faker->text(80),
		        'content'		=> $faker->text(600),
	            'thing_id'		=> $faker->numberBetween(1,100),
	            'user_id'		=> $faker->numberBetween(1,3)
		    ]);
			    
			// Then save rating
		    $rating = [
		        'rating'		=> $faker->numberBetween(1,5),
	            'user_id'		=> $review->user_id
		    ];
			$review->find($review->id)->rating()->save(new Rating($rating));
	
	    }
	    
	}

}
