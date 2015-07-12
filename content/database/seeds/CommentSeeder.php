<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Comment;

class CommentSeeder extends Seeder {

	/**
	 * Run the admin seeder.
	 *
	 * @return void
	 */
	public function run()
	{
		
		// Create an instance of Faker
		$faker = Faker\Factory::create();
		
		for ($i=0;$i<200;$i++){
			
		    Comment::create([
		        'comment'	=> $faker->text(200),
	            'review_id'	=> $faker->numberBetween(1,100),
	            'user_id'	=> $faker->numberBetween(1,3)
		    ]);
		    
	    }
	    
	}

}
