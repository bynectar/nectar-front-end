<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Vote;
use App\Models\Review;
use App\Models\Thing;
use App\Models\Category;

class VoteSeeder extends Seeder {

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
			
			// Set vars
			$selector 		= $faker->numberBetween(1,3);
			$review_id 		= null;
			$thing_id 		= null;
			$category_id 	= null;
			if ($selector === 1){
				$review_id = $faker->numberBetween(1,100);
			} elseif ($selector === 2){
				$thing_id = $faker->numberBetween(1,100);
			} elseif ($selector === 3){
				$category_id = $faker->numberBetween(1,10);
			}
			
			// Create vote
		    Vote::create([
	            'review_id'		=> $review_id,
		        'thing_id'		=> $thing_id,
		        'category_id'	=> $category_id,
	            'user_id'		=> $faker->numberBetween(1,3)
		    ]);
		    
		    // Increment vote counter
		    if ( $review_id != null ){
			    $review = Review::find($review_id);
			    $review->votes_count = $review->votes()->count();
			    $review->update();
		    } elseif ( $thing_id != null ) {
			    $thing = Thing::find($thing_id);
			    $thing->votes_count = $thing->votes()->count();
			    $thing->update();
		    } elseif ( $category_id != null ) {
			    $category = Category::find($category_id);
			    $category->votes_count = $category->votes()->count();
			    $category->update();
		    }
		    
	    }
	    
	}

}
