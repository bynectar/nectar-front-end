<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Flag;
use App\Models\Review;
use App\Models\Thing;
use App\Models\Comment;

class FlagSeeder extends Seeder {

	/**
	 * Run the admin seeder.
	 *
	 * @return void
	 */
	public function run()
	{
		
		// Create an instance of Faker
		$faker = Faker\Factory::create();
		
		for ($i=0;$i<10;$i++){
			
			// Set vars
			$selector 		= $faker->numberBetween(1,3);
			$review_id 		= null;
			$thing_id 		= null;
			$comment_id 	= null;
			if ($selector === 1){
				$review_id = $faker->numberBetween(1,100);
			} elseif ($selector === 2){
				$thing_id = $faker->numberBetween(1,100);
			} elseif ($selector === 3){
				$comment = $faker->numberBetween(1,200);
			}
			
		    // Create flag
		    Flag::create([
		        'type'			=> $faker->randomElement(['abusive', 'offensive', 'spam', 'illegal', 'other']),
	            'review_id'		=> $review_id,
	            'thing_id'		=> $thing_id,
	            'comment_id'	=> $comment_id,
	            'user_id'		=> $faker->numberBetween(1,3)
		    ]);
		    
		    // Increment flag counter
		    if ( $review_id != null ){
			    $review = Review::find($review_id);
			    $review->flags_count = $review->flags()->count();
			    $review->update();
		    } elseif ( $thing_id != null ) {
			    $thing = Thing::find($thing_id);
			    $thing->flags_count = $thing->flags()->count();
			    $thing->update();
		    } elseif ( $comment_id != null ) {
			    $comment = Comment::find($comment_id);
			    $comment->flags_count = $comment->flags()->count();
			    $comment->update();
		    }

	    }
	    
	}

}
