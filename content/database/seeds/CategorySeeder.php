<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class CategorySeeder extends Seeder {

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
			
		    Category::create([
		        'title'			=> $faker->text(80),
		        'description'	=> $faker->text(140),
	            'user_id'		=> $faker->numberBetween(1,3)
		    ]);
		    
	    }
	    
	}

}
